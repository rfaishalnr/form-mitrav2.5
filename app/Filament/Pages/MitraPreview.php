<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\MitraPendaftaran;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class MitraPreview extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.mitra-preview';
    protected static ?string $title = 'Mitra Preview';
    protected static ?string $navigationLabel = '3. Mitra Preview';
    protected static ?int $navigationSort = 3;

    public ?MitraPendaftaran $data = null;
    public Collection $allData;
    public array $boqData = [];

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    public function mount(): void
    {
        try {
            // Get all mitra data first
            $this->allData = MitraPendaftaran::all();
            
            // Get ID from route or query parameter
            $id = Request::route('record') ?? Request::query('id');
            
            // Try to find specific mitra or get the latest one
            if ($id) {
                $this->data = MitraPendaftaran::find($id);
                
                // If specific ID not found, try to get latest
                if (!$this->data && $this->allData->isNotEmpty()) {
                    $this->data = $this->allData->first();
                }
            } else {
                // No ID specified, get the latest one if available
                $this->data = $this->allData->first();
            }
            
            // Load BOQ data if mitra data exists
            if ($this->data) {
                try {
                    // Try to load boqLines relationship
                    $this->data->load('boqLines');
                    $this->boqData = $this->data->boqLines ? $this->data->boqLines->toArray() : [];
                } catch (\Exception $e) {
                    // If relationship doesn't exist or fails to load
                    $this->boqData = [];
                }
            }
            
        } catch (\Exception $e) {
            // Log the error for debugging
            // \Log::error('MitraPreview mount error: ' . $e->getMessage());
            
            // Initialize with empty data to prevent errors
            $this->data = null;
            $this->allData = collect();
            $this->boqData = [];
        }
    }

    private function loadBoqData(): void
    {
        try {
            $this->data->load('boqLines');
            $this->boqData = $this->data->boqLines ? $this->data->boqLines->toArray() : [];
        } catch (\Exception $e) {
            $this->boqData = [];
        }
    }

    private function getLastSelectedMitra(): ?MitraPendaftaran
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }
        
        $query = MitraPendaftaran::orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc');
        
        if ($user->id !== 1) {
            $query->where('user_id', $user->id);
        }
        
        return $query->first();
    }

    protected function getViewData(): array
    {
        return [
            'data' => $this->data,
            'allData' => $this->allData,
            'mitras' => $this->allData,
            'hasData' => !is_null($this->data),
            'boqData' => collect($this->boqData),
            'hasBoqData' => !empty($this->boqData),
            'currentUserId' => Auth::id(),
        ];
    }

    public function hasData(): bool
    {
        return !is_null($this->data);
    }

    public function getTotalMitra(): int
    {
        return $this->allData->count();
    }

    public function selectMitra($mitraId): void
    {
        try {
            $user = Auth::user();
            $mitra = MitraPendaftaran::find($mitraId);
            
            if (!$mitra) {
                session()->flash('error', 'Data mitra tidak ditemukan.');
                return;
            }
            
            // Validasi akses user
            if ($user->id !== 1 && $mitra->user_id !== $user->id) {
                session()->flash('error', 'Anda tidak memiliki izin untuk melihat data mitra ini.');
                return;
            }
            
            // Set data yang dipilih
            $this->data = $mitra;
            
            // Load BOQ data
            $this->loadBoqData();
            
            // Optional: Update URL untuk konsistensi
            $this->redirectRoute('filament.admin.pages.mitra-preview', ['id' => $mitraId]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memuat data mitra yang dipilih.');
        }
    }

    public function getMitraOptions(): array
    {
        return $this->allData->mapWithKeys(function ($mitra) {
            return [$mitra->id => $mitra->nama_mitra . ' - ' . $mitra->nama_pekerjaan];
        })->toArray();
    }
}