@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="mb-6 flex flex-col">
        <div class="py-2">
            <h2 class="text-3xl font-bold text-blue-store">
                Datos personales
            </h2>
        </div>

        <div class="mt-4 border-t border-zinc-200 py-4">
            <div class="group relative h-40 w-40 rounded-full">
                @if ($user->google_id && !$user->profile)
                    <img src="{{ $user->google_profile }}" alt="profile" class="h-full w-full rounded-full object-cover"
                        id="image-profile">
                @else
                    <img src="{{ Storage::url($user->profile) }}" alt="profile"
                        class="h-full w-full rounded-full object-cover" id="image-profile">
                @endif
                <form action="{{ Route('account.change-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="photo-profile"
                        class="absolute inset-0 flex cursor-pointer items-center justify-center rounded-full bg-black bg-opacity-40 text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <x-icon-store icon="edit" class="h-5 w-5" />
                        <input type="file" name="profile" id="photo-profile" class="hidden" />
                    </label>
                </form>
            </div>
        </div>

        <div class="border-t border-zinc-200">
            @if (session('warning') && !session('success') && !session('error'))
                <div class="mt-4 flex flex-row items-center gap-2 rounded-xl border border-yellow-500 bg-yellow-500/10 p-4">
                    <x-icon-store icon="alert" class="h-5 w-5 text-yellow-500" />
                    <p class="font-dine-r text-sm text-yellow-500">
                        {{ session('warning') }}
                    </p>
                </div>
            @endif

            @if (session('success'))
                <div class="mt-4 flex flex-row items-center gap-2 rounded-xl border border-green-500 bg-green-500/10 p-4">
                    <x-icon-store icon="check-duotone" class="h-5 w-5 text-green-500" />
                    <p class="font-dine-r text-sm text-green-500">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 flex flex-row items-center gap-2 rounded-xl border border-red-500 bg-red-500/10 p-4">
                    <x-icon-store icon="alert" class="h-5 w-5 text-red-500" />
                    <p class="font-dine-r text-sm text-red-500">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            <div class="mt-4 flex flex-col">
                <h3 class="text-base font-bold text-blue-store sm:text-lg">
                    Datos de seguridad
                </h3>
                <div class="mt-2">
                    <div class="flex flex-col text-sm sm:text-base">
                        <div class="flex items-center justify-between gap-2">
                            <div class="items-tart flex flex-col gap-2 sm:flex-row sm:items-center">
                                <h4 class="text-secondary font-dine-r font-semibold text-zinc-800">Correo electrónico:</h4>
                                <p class="flex items-center gap-x-4 font-dine-r text-zinc-600">
                                    {{ $user->email }}
                                    @if ($user->email_verified_at || $user->google_id)
                                        <span
                                            class="flex items-center justify-center gap-x-1 font-dine-r text-xs text-green-500">
                                            <x-icon-store icon="check-bold" class="h-5 w-5 text-current" />
                                            Correo verificado
                                        </span>
                                    @endif
                                </p>
                            </div>
                            @if (!$user->email_verified_at && !$user->google_id)
                                <x-button-store type="a" href="{{ Route('verification.notice') }}" icon="mail-02"
                                    text="Verificar correo" typeButton="secondary" class="w-max" size="small" />
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 text-sm sm:mt-4 sm:text-base">
                        <div class="flex items-center gap-2">
                            <h4 class="font-dine-r font-semibold text-zinc-800">Contraseña:</h4>
                            <div class="flex items-center gap-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                                <div class="h-1.5 w-1.5 rounded-full bg-zinc-600"></div>
                            </div>
                        </div>
                        <div class="mt-1">
                            <p class="font-dine-r text-xs text-zinc-600">
                                Última actualización:
                                {{ $user->updated_at->diffForHumans() }}
                            </p>
                        </div>
                        @if (!$user->google_id)
                            <div class="mt-4">
                                <x-button-store type="a" href="{{ Route('account.change-password') }}"
                                    text="Cambiar contraseña" icon="reset-password" typeButton="secondary"
                                    class="w-max px-16" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4 border-t border-zinc-200">
                <div class="flex items-center justify-between pt-4">
                    <h3 class="text-base font-bold text-blue-store sm:text-lg">Datos personales</h3>
                    <x-button-store type="a" href="{{ Route('account.settings-edit') }}" text="Editar datos"
                        typeButton="success" class="w-max" size="small" />
                </div>
                <div class="mt-2 flex flex-col gap-3 text-sm sm:text-base">
                    <div class="flex gap-2">
                        <h4 class="font-dine-r font-semibold text-zinc-800">Usuario:</h4>
                        <p class="font-dine-r text-zinc-600">{{ $user->username }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h4 class="font-dine-r font-semibold text-zinc-800">Nombres:</h4>
                        <p class="font-dine-r text-zinc-600">{{ $user->name ?? 'No definido' }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h4 class="font-dine-r font-semibold text-zinc-800">Apellidos:</h4>
                        <p class="font-dine-r text-zinc-600">{{ $user->last_name ?? 'No definido' }}</p>
                    </div>
                    <div class="flex flex-col justify-between gap-2 sm:flex-row sm:gap-0">
                        <div class="flex items-center gap-2">
                            <h4 class="font-dine-r font-semibold text-zinc-800">Género:</h4>
                            <span class="flex items-center gap-1 font-dine-r text-zinc-600">
                                @if ($user->customer)
                                    @if ($user->customer->gender === 'female')
                                        <x-icon-store icon="female" class="h-6 w-6 text-rose-500" />
                                        Femenino
                                    @else
                                        <x-icon-store icon="male" class="h-5 w-5 text-primary" />
                                        Masculino
                                    @endif
                                @else
                                    No definido
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-dine-r font-semibold text-zinc-800">Telefono:</h4>
                            <p class="font-dine-r text-zinc-600">{{ $user->customer->phone ?? 'No definido' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-dine-r font-semibold text-zinc-800">Fecha de nacimiento:</h4>
                            <p class="font-dine-r text-zinc-600">
                                {{ isset($user->customer->birthdate) ? \Carbon\Carbon::parse($user->customer->birthdate)->format('d M, Y') : 'Sin definir' }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-2 border-t border-zinc-200">
                        <div class="flex items-center justify-between pt-4">
                            <h3 class="text-base font-semibold text-blue-store sm:text-lg">
                                Dirección por defecto
                            </h3>
                            @if ($user->customer && $user->customer->address)
                                <x-button-store type="a"
                                    href="{{ Route('account.addresses.edit', $user->customer->address->slug) }}"
                                    text="Editar dirección" typeButton="success" class="w-max" size="small" />
                            @else
                                <x-button-store type="a" href="{{ Route('account.addresses.create') }}"
                                    text="Agregar dirección" typeButton="success" class="w-max" size="small" />
                            @endif
                        </div>
                        @if ($user->customer && $user->customer->address)
                            <div class="mt-3 flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Dirección:</h4>
                                <p class="font-dine-r text-zinc-800">
                                    {{ $user->customer->address->address_line_1 . ', ' . $user->customer->address->address_line_2 }}
                                </p>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Código postal:</h4>
                                <p class="font-dine-r text-zinc-600">
                                    {{ $user->customer->address->zip_code }}
                                </p>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Departamento:</h4>
                                <p class="font-dine-r text-zinc-600">
                                    {{ $user->customer->address->department ?? '---' }}
                                </p>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Municipio:</h4>
                                <p class="font-dine-r text-zinc-600">
                                    {{ $user->customer->address->municipality ?? '---' }}
                                </p>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Distrito:</h4>
                                <p class="font-dine-r text-zinc-600">
                                    {{ $user->customer->address->district ?? '---' }}
                                </p>
                            </div>
                        @else
                            <div class="mt-3 rounded-xl border-2 border-dashed border-blue-400 bg-blue-50 p-8 text-sm">
                                <p class="text-center font-dine-r text-blue-400">
                                    No has definido una dirección
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tab-pet" class="tab-panel hidden">
        <div class="mt-4">
            <div class="text-left">
                <h1 class="text-4xl font-bold text-light-blue">Datos de tu mascota</h1>
            </div>
            <form action="" class="mt-4 flex flex-col gap-4">
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex flex-[2] flex-col gap-2">
                        <x-input-store type="text" name="name_pet" placeholder="Nombre" label="Nombre" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="number" name="year_pet" placeholder="Edad" label="Edad" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-select-store id="gender_pet" :options="['Macho' => 'Macho', 'Hembra' => 'Hembra']" name="gender_pet" label="Género" />
                    </div>
                </div>
                <div class="mt-2 flex items-center gap-8">
                    <div class="flex items-center gap-2">
                        <label for="" class="text-start text-sm font-medium text-zinc-600 md:text-base">
                            Gato
                        </label>
                        <input type="radio" name="pet" value="cat">
                    </div>
                    <div class="flex items-center gap-2">
                        <label for="" class="text-start text-sm font-medium text-zinc-600 md:text-base">
                            Perro
                        </label>
                        <input type="radio" name="pet" value="dog">
                    </div>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="textarea" name="info_pet"
                            placeholder="Menciona si padece alguna enfermedad" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="textarea" name="color_pet"
                            placeholder="Menciona algún requisito en tu pedido" />
                    </div>
                </div>
                <div class="mt-4 flex">
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="textarea" name="description_pet"
                            placeholder="Cuentanos más acerca de tu mascota" />
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <x-button-store text="Guardar cambios" class="w-full sm:w-auto" icon="save"
                        typeButton="primary" />
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/account.js')
@endpush
