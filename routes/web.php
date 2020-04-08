<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {return view('dashboard.homepage');});

    Route::get('/home', function () {return view('dashboard.homepage');});

    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/colors', function () {return view('dashboard.colors');});
        Route::get('/typography', function () {return view('dashboard.typography');});
        Route::get('/charts', function () {return view('dashboard.charts');});
        Route::get('/widgets', function () {return view('dashboard.widgets');});
        Route::get('/404', function () {return view('dashboard.404');});
        Route::get('/500', function () {return view('dashboard.500');});
        Route::prefix('base')->group(function () {
            Route::get('/breadcrumb', function () {return view('dashboard.base.breadcrumb');});
            Route::get('/cards', function () {return view('dashboard.base.cards');});
            Route::get('/carousel', function () {return view('dashboard.base.carousel');});
            Route::get('/collapse', function () {return view('dashboard.base.collapse');});

            Route::get('/forms', function () {return view('dashboard.base.forms');});
            Route::get('/jumbotron', function () {return view('dashboard.base.jumbotron');});
            Route::get('/list-group', function () {return view('dashboard.base.list-group');});
            Route::get('/navs', function () {return view('dashboard.base.navs');});

            Route::get('/pagination', function () {return view('dashboard.base.pagination');});
            Route::get('/popovers', function () {return view('dashboard.base.popovers');});
            Route::get('/progress', function () {return view('dashboard.base.progress');});
            Route::get('/scrollspy', function () {return view('dashboard.base.scrollspy');});

            Route::get('/switches', function () {return view('dashboard.base.switches');});
            Route::get('/tables', function () {return view('dashboard.base.tables');});
            Route::get('/tabs', function () {return view('dashboard.base.tabs');});
            Route::get('/tooltips', function () {return view('dashboard.base.tooltips');});
        });
        Route::prefix('buttons')->group(function () {
            Route::get('/buttons', function () {return view('dashboard.buttons.buttons');});
            Route::get('/button-group', function () {return view('dashboard.buttons.button-group');});
            Route::get('/dropdowns', function () {return view('dashboard.buttons.dropdowns');});
            Route::get('/brand-buttons', function () {return view('dashboard.buttons.brand-buttons');});
        });
        Route::prefix('icon')->group(function () {
            // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function () {return view('dashboard.icons.coreui-icons');});
            Route::get('/flags', function () {return view('dashboard.icons.flags');});
            Route::get('/brands', function () {return view('dashboard.icons.brands');});
        });
        Route::prefix('notifications')->group(function () {
            Route::get('/alerts', function () {return view('dashboard.notifications.alerts');});
            Route::get('/badge', function () {return view('dashboard.notifications.badge');});
            Route::get('/modals', function () {return view('dashboard.notifications.modals');});
        });
        Route::resource('notes', 'NotesController');
    });

    Auth::routes();

    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index'   => 'resource.index',
        'create'  => 'resource.create',
        'store'   => 'resource.store',
        'show'    => 'resource.show',
        'edit'    => 'resource.edit',
        'update'  => 'resource.update',
        'destroy' => 'resource.destroy',
    ]);

    // semua router yang ada di dalam sini adalah router yang dapat di akses oleh
    // admin it sekolah
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('bread', 'BreadController'); //create BREAD (resource)
        Route::resource('users', 'UsersController')->except(['create', 'store']);
        Route::resource('roles', 'RolesController');
        Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/', 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create', 'MenuElementController@create')->name('menu.create');
            Route::post('/store', 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents', 'MenuElementController@getParents');
            Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update', 'MenuElementController@update')->name('menu.update');
            Route::get('/show', 'MenuElementController@show')->name('menu.show');
            Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('menu.menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'MenuController@store')->name('menu.menu.store');
            Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update', 'MenuController@update')->name('menu.menu.update');
            Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/', 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store', 'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update', 'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder', 'MediaController@folder')->name('media.folder');
            Route::post('/folder/move', 'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete', 'MediaController@folderDelete')->name('media.folder.delete');
            Route::post('/file/store', 'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file', 'MediaController@file');
            Route::post('/file/delete', 'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update', 'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move', 'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp', 'MediaController@cropp');
            Route::get('/file/copy', 'MediaController@fileCopy')->name('media.file.copy');
        });

        //utuk mendalftarakan siswa oleh admin
        Route::resource('siswa', 'SiswaManagementController');
        //untuk guru dan staff yang di atur oleh admin
        Route::resource('guru', 'GuruManagementController');
        //untuk mengatur mata pelajaran oleh admin
        Route::resource('mapel', 'MapelController');
        //route untuk tahun ajaran
        Route::resource('ta', 'TahunAjaranController');

        //route untuk kelas by admin
        Route::resource('kelas', 'KelasManagement');

        Route::put('activeKelas/{kelas}', 'KelasManagement@active')->name('active.kelas');
        Route::put('nonactiveKelas/{kelas}', 'KelasManagement@nonactive')->name("nonactive.kelas");
        //route ini untuk admin mengatur matapelajaran didalam kelas

        Route::get('KelasMapel/{kelas}/create', 'KelasMapelController@create')->name('KelasMapel.create');
        Route::post('KelasMapel', 'KelasMapelController@store')->name('KelasMapel.store');
        Route::get('KelasMapel/{kelasmapel}/edit', 'KelasMapelController@edit')->name('KelasMapel.edit');
        Route::put('KelasMapel/{kelasmapel}', 'KelasMapelController@update')->name('KelasMapel.update');
        Route::delete('KelasMapel/{kelasmapel}', 'KelasMapelController@destroy')->name('KelasMapel.destroy');

        //route untuk menghubungakan admin kelas dan siswa.

        Route::get('KelasSiswa/{KelasSiswa}/create', 'KelasSiswaController@create')->name('KelasSiswa.create');
        Route::post('KelasSiswa/', 'KelasSiswaController@store')->name('KelasSiswa.store');
        Route::delete('KelasSiswa/{KelasSiswa}/destroy', 'KelasSiswaController@destroy')->name('KelasSiswa.destroy');
        //route untuk menampilan kan mata pelajarn yang diterima siswa dalam kelas terpilih

    });

    Route::group(['middleware' => ['role:admin|guru']], function () {

        Route::resource('/guru_data_diri', 'GuruDataDiriController');
        Route::get('KelasMapel/{kelas}', 'KelasMapelController@index')
            ->name('KelasMapel.index');
        Route::get('KelasSiswa/{KelasSiswa}', 'KelasSiswaController@index')
            ->name('KelasSiswa.index');
        Route::get("KelasSiswaMapel/{kelas}",
            "KelasSiswaMapelController@index")
            ->name("KelasSiswaMapel.index");

        Route::get("KelasAbsentSiswa/{attedees}",
            "KelasSiswaMapelController@attendees")
            ->name("KelasAbsentSiswa.attendees");

        Route::get("extrakurikuler/{extrakurikuler}",
            "KelasSiswaMapelController@extrakurikuler")
            ->name("extrakurikuler.extrakurikuler");
        Route::get("extrakurikuler/{extrakurikuler}/create",
            "KelasSiswaMapelController@extrakurikulerCreate")
            ->name('extrakurikuler.create');
        Route::get("extrakurikuler/{kelas}/{extrakurikuler}/edit",
            "KelasSiswaMapelController@extrakurikulerEdit")
            ->name('extrakurikuler.edit');
        Route::post("extrakurikuler/{extrakurikuler}/store",
            "KelasSiswaMapelController@extrakurikulerStore")
            ->name('extrakurikuler.store');

        Route::put("extrakurikuler/{kelas}/{extra}/update",
            "KelasSiswaMapelController@extrakurikulerUpdate")
            ->name('extrakurikuler.update');

        Route::delete("extrakurikuler/{extrakurikuler}/delete",
            "KelasSiswaMapelController@extrakurikulerDestroy")
            ->name('extrakurikuler.delete');
        Route::get('/cetak_laporan_semester/{KelasSiswa}/index',
            'LaporanController@index')
            ->name('cetak_laporan_semester');
        Route::post('/cetak_laporan_semester/',
            'LaporanController@adminReport')
            ->name('cetak_laporan_semester.store');

    });

    /**
     * semua route pada midleware guru hanya dapat di akses oleh guru
     **/
    Route::group(['middleware' => ['role:guru']], function () {
        Route::get('guru_kelas_siswa', 'GuruController@index')
            ->name('guru_keles_siswa.index');
        Route::get('guru_kelas_siswa/{kelas}/show', 'GuruController@show')
            ->name('guru_kelas_siswa.show');
        //untuk absensi siswa/i
        Route::get("guru_kelas_siswa/{kelas}/{semester}/attendees",
            "KelasSiswaMapelController@attendeesEdit")
            ->name('KelasAbsentSiswa.attendeesEdit');

        Route::put('attendees/{kelas}/{semester}',
            "KelasSiswaMapelController@attendeesUpdate")
            ->name('attendees.attendeesUpdate');
        Route::get('guru_kelas_siswa/{kelas}/{mapel}/{semester}/nilai_mapel',
            'GuruController@edit')->name('guru_mapel_nilai.edit');
        Route::put('guru_kelas_siswa/{kelas}/{mapel}/{semester}/nilai_mapel',
            'GuruController@update')->name('guru_mapel_nilai.update');
    });

    Route::group(['middleware' => ['role:siswa']], function () {
        Route::resource('/siswa_kelas_akses', 'SiswaController');
        Route::resource('/siswa_kelas_print', 'SiswaPrintMandiriController')->only(['index', 'store']);

        Route::resource('/data_diri_siswa', 'SiswaDataDiriController');
    });

});
