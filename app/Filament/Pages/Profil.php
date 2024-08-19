<?php

namespace App\Filament\Pages;

use App\Models\GelarPendidikan;
use App\Models\Jabatan;
use App\Models\PendidikanTerakhir;
use App\Models\PosisiKerja;
use App\Models\StatusKepegawaian;
use App\Models\Unit;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class Profil extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profil';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    // ketika halaman pertama kali muncul
    public function mount(): void
    {
        // isi form dengan data
        $this->form->fill([
            'name'  => auth()->user()->name,
            'email'  => auth()->user()->email,
            'npy'  => auth()->user()?->karyawan?->npy,
            'nik'  => auth()->user()?->karyawan?->nik,
            'nama_lengkap'  => auth()->user()?->karyawan?->nama_lengkap,
            'jenis_kelamin'  => auth()->user()?->karyawan?->jenis_kelamin,
            'tempat_lahir'  => auth()->user()?->karyawan?->tempat_lahir,
            'tanggal_lahir'  => auth()->user()?->karyawan?->tanggal_lahir,
            'alamat'  => auth()->user()?->karyawan?->alamat,
            'nomor_telepon'  => auth()->user()?->karyawan?->nomor_telepon,
            'jabatan_id'  => auth()->user()?->karyawan?->jabatan_id,
            'posisi_kerja_id'  => auth()->user()?->karyawan?->posisi_kerja_id,
            'unit_id'  => auth()->user()?->karyawan?->unit_id,
            'tanggal_mulai_bekerja'  => auth()->user()?->karyawan?->tanggal_mulai_bekerja,
            'status_karyawan_id'  => auth()->user()?->karyawan?->status_karyawan_id,
            'pendidikan_terakhir_id'  => auth()->user()?->karyawan?->pendidikan_terakhir_id,
            'scan_ktp'  => url('storage/' . auth()->user()?->karyawan?->scan_ktp),
            'foto_karyawan'  => url('storage/' . auth()->user()?->karyawan?->foto_karyawan),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pengguna')
                    ->description('Ubah data pengguna')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Username')
                            ->placeholder('Nama Pengguna')
                            ->autofocus()
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Email')
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->placeholder('Password')
                            ->helperText(new HtmlString('<small style="color:red">Isi jika ingin diubah</small>'))
                            ->password()
                            ->revealable()
                            ->confirmed()
                            ->required(fn(string $operation) => $operation == 'create'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->placeholder('Konfirmasi Password')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->required(fn(string $operation) => $operation == 'create'),
                    ]),
                Forms\Components\Section::make('Data Karyawan')
                    ->description('Ubah data karyawan')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Wizard::make([
                            Forms\Components\Wizard\Step::make('Biodata')
                                ->columns(3)
                                ->schema([
                                    Forms\Components\TextInput::make('npy')
                                        ->label('Nomor Pegawai')
                                        ->placeholder('Nomor Induk Pegawai'),
                                    Forms\Components\TextInput::make('nik')
                                        ->label('NIK')
                                        ->placeholder('Nomor Induk Kependudukan')
                                        ->extraInputAttributes([
                                            'minLength' => 16,
                                            'maxLength' => 16,
                                            'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');",
                                        ]),
                                    Forms\Components\TextInput::make('nama_lengkap')
                                        ->label('Nama Lengkap')
                                        ->placeholder('Nama Lengkap')
                                        ->required(),
                                    Forms\Components\Select::make('jenis_kelamin')
                                        ->label('Jenis Kelamin')
                                        ->native(false)
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan',
                                        ]),
                                    Forms\Components\TextInput::make('tempat_lahir')
                                        ->label('Tempat lahir')
                                        ->placeholder('Tempat lahir'),
                                    Forms\Components\DatePicker::make('tanggal_lahir')
                                        ->label('Tanggal Lahir')
                                        ->placeholder('d/m/Y')
                                        ->native(false)
                                        ->displayFormat('d/m/Y'),
                                    Forms\Components\Textarea::make('alamat')
                                        ->label('Alamat')
                                        ->placeholder('Isi dengan singkat dan jelas')
                                        ->rows(5)
                                        ->autosize()
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('nomor_telepon')
                                        ->label('No HP Aktif')
                                        ->placeholder('Contoh: 081234xxxxxx')
                                        ->columnSpanFull()
                                        ->extraInputAttributes([
                                            'minLength' => 10,
                                            'maxLength' => 15,
                                            'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');",
                                        ]),
                                    Forms\Components\TextInput::make('nama_pasangan')
                                        ->label('Nama Pasangan')
                                        ->placeholder('Nama Suami/Istri'),
                                    Forms\Components\TextInput::make('jumlah_anak')
                                        ->label('Jumlah Anak')
                                        ->placeholder('Jumlah Anak')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('kontak_darurat')
                                        ->label('Kontak Darurat')
                                        ->placeholder('Kontak Darurat'),
                                ]),
                            Forms\Components\Wizard\Step::make('Data Tambahan')
                                ->schema([
                                    Forms\Components\Section::make('Data Pekerjaan')
                                        ->description('Meliputi jabatan, posisi unit dan tanggal mulai bekerja di Al-Fityan')
                                        ->columns(4)
                                        ->schema([
                                            Forms\Components\Select::make('status_karyawan_id')
                                                ->label('Status Kepegawaian')
                                                ->placeholder('Pilih Status Kepegawaian')
                                                ->searchable()
                                                ->preload()
                                                ->options(StatusKepegawaian::all()->pluck('status', 'id'))
                                                ->columnSpanFull(),
                                            Forms\Components\Select::make('posisi_kerja_id')
                                                ->label('Posisi Pekerjaan')
                                                ->placeholder('Pilih Posisi Pekerjaan')
                                                ->searchable()
                                                ->preload()
                                                ->options(PosisiKerja::all()->pluck('nama_posisi_kerja', 'id')),
                                            Forms\Components\Select::make('jabatan_id')
                                                ->label('Jabatan')
                                                ->placeholder('Pilih Jabatan')
                                                ->searchable()
                                                ->preload()
                                                ->options(Jabatan::all()->pluck('nama_jabatan', 'id')),
                                            Forms\Components\Select::make('unit_id')
                                                ->label('Unit')
                                                ->placeholder('Pilih Unit')
                                                ->searchable()
                                                ->preload()
                                                ->options(Unit::all()->pluck('nama_unit', 'id')),
                                            Forms\Components\DatePicker::make('tanggal_mulai_bekerja')
                                                ->label('Tanggal Mulai Bekerja')
                                                ->placeholder('d/m/Y')
                                                ->native(false)
                                                            ->displayFormat('d/m/Y'),
                                        ]),
                                    Forms\Components\Section::make('Data Pendidikan')
                                        ->description('Data pendidikan terakhir, jurusan, Institusi pendidikan dan pelatihan pengembangan diri yang pernah diikuti')
                                        ->columns(3)
                                        ->schema([
                                            Forms\Components\Grid::make()
                                            ->columnSpanFull()
                                            ->schema([
                                            Forms\Components\Select::make('pendidikan_terakhir_id')
                                                        ->label('Pendidikan Terakhir')
                                                        ->placeholder('Pilih Pendidikan Terakhir')
                                                        ->searchable()
                                                        ->preload()
                                                        ->options(PendidikanTerakhir::all()->pluck('nama_pendidikan_terakhir', 'id')),
                                                    Forms\Components\Select::make('gelar_pendidikan_id')
                                                        ->label('Gelar Pendidikan')
                                                        ->placeholder('Pilih Gelar Pendidikan')
                                                        ->searchable()
                                                        ->preload()
                                                        ->options(GelarPendidikan::all()->pluck('nama_gelar_pendidikan', 'id')),
                                                ])->columns(2),
                                            Forms\Components\TextInput::make('institusi_pendidikan')
                                                ->label('Nama Institusi Pendidikan')
                                                ->placeholder('Nama Institusi Pendidikan'),
                                            Forms\Components\TextInput::make('jurusan')
                                                ->label('Jurusan')
                                                ->placeholder('Jurusan'),
                                            Forms\Components\TextInput::make('tahun_lulus')
                                                ->label('Tahun Kelulusan')
                                                ->placeholder('Tahun Kelulusan')
                                                ->extraInputAttributes([
                                                    'minLength' => 4,
                                                    'maxLength' => 4,
                                                    'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');",
                                                ]),
                                        ]),
                                ]),
                            Forms\Components\Wizard\Step::make('Dokumen')
                                ->description('Seluruh dokumen wajib discan rapi')
                                ->schema([
                                    Forms\Components\Section::make('Dokumen Biodata Diri')
                                        ->columns(3)
                                        ->schema([
                                            Forms\Components\FileUpload::make('foto_karyawan')
                                                ->label('Foto Karyawan')
                                                ->imageEditor()
                                                ->directory('fotoKaryawan'),
                                            Forms\Components\FileUpload::make('scan_ktp')
                                                ->label('KTP')
                                                ->imageEditor()
                                                ->disk('public')
                                                ->visibility('private')
                                                ->directory('ktp'),
                                            Forms\Components\FileUpload::make('scan_kk')
                                                ->label('Kartu Keluarga')
                                                ->imageEditor()
                                                ->directory('kk'),
                                        ]),
                                    Forms\Components\Section::make('Dokumen Ijazah & Sertifikat')
                                        ->columns(3)
                                        ->schema([
                                            Forms\Components\FileUpload::make('scan_ijazah_terakhir')
                                                ->label('Ijazah Terakhir')
                                                ->imageEditor()
                                                ->directory('ijazah'),
                                            Forms\Components\FileUpload::make('scan_sertifikat_penghargaan')
                                                ->label('Sertifikat Penghargaan')
                                                ->imageEditor()
                                                ->directory('penghargaan'),
                                            Forms\Components\FileUpload::make('sertifikat_prestasi')
                                                ->label('Sertifikat Prestasi')
                                                ->imageEditor()
                                                ->directory('prestasi'),
                                        ]),
                                    Forms\Components\Section::make('Dokumen SK')
                                        ->columns(2)
                                        ->schema([
                                        Forms\Components\FileUpload::make('scan_sk_yayasan')
                                        ->label('SK Yayasan')
                                        ->imageEditor()
                                        ->directory('sk_yayasan'),
                                        Forms\Components\FileUpload::make('scan_sk_mengajar')
                                        ->label('SK Mengajar')
                                        ->imageEditor()
                                        ->directory('sk_mengajar'),
                                        ]),
                                ]),
                        ])
                            ->persistStepInQueryString()    // Kalau refresh halaman tetap berada di step sebelunya
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data')
            ->model(auth()->user());
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('Ubah')
                ->color('primary')
                ->submit('update'),
        ];
    }

    public function update()
    {
        // dd($this->form->getState());
        $data = $this->form->getState();
        // Simpan data pengguna
        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        // jika password diisi maka tambahkan password ke dalam array $user untuk di update
        if ($data['password']) {
            $user['password'] = $data['password'];
        }
        auth()->user()->update($user);
        
        // Simpan data karyawan
        $karyawan = [
            'npy' => $data['npy'],
            'nama_lengkap' => $data['nama_lengkap'],
            'nik' => $data['nik'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'nomor_telepon' => $data['nomor_telepon'],
            'jabatan_id' => $data['jabatan_id'],
            'posisi_kerja_id' => $data['posisi_kerja_id'],
            'unit_id' => $data['unit_id'],
            'tanggal_mulai_bekerja' => $data['tanggal_mulai_bekerja'],
            'status_karyawan_id' => $data['status_karyawan_id'],
            'pendidikan_terakhir_id' => $data['pendidikan_terakhir_id'],
            'gelar_pendidikan_id' => $data['gelar_pendidikan_id'],
            'jurusan' => $data['jurusan'],
            'institusi_pendidikan' => $data['institusi_pendidikan'],
            'tahun_lulus' => $data['tahun_lulus'],
            'nama_pasangan' => $data['nama_pasangan'],
            'jumlah_anak' => $data['jumlah_anak'],
            'kontak_darurat' => $data['kontak_darurat'],
            'foto_karyawan' => $data['foto_karyawan'],
            'scan_ktp' => $data['scan_ktp'],
            'scan_kk' => $data['scan_kk'],
            'scan_ijazah_terakhir' => $data['scan_ijazah_terakhir'],
        ];
        auth()->user()->karyawan()->updateOrCreate([
            'user_id' => auth()->user()->id,
        ], $karyawan);


        Notification::make()
            ->title('Profil berhasil diubah!')
            ->success()
            ->send();

        redirect()->route('filament.admin.pages.profil');
    }
}
