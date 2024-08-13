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
use Illuminate\Support\HtmlString;

class Profil extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profil';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        // $this->form->fill([
        //     'name'  => auth()->user()?->name,
        // ]);
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
                            ->label('Nama Lengkap')
                            ->autofocus()
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
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
                                        ->placeholder('Nama Lengkap'),
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
            Actions\Action::make('Update')
                ->color('primary')
                ->submit('update'),
        ];
    }

    public function update()
    {
        auth()->user()->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Profil berhasil diubah!')
            ->success()
            ->send();
    }
}
