@extends('layouts.template')
@section('title', 'Miguitas | Mi cuenta')
@section('content')
    <div class="py-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-light-blue">Mi cuenta</h1>
        </div>
        <div class="mx-auto flex w-3/4 gap-8 py-10">
            <div>
                @if ($user->google_id)
                    <img src="{{ $user->google_profile }}"
                        class="h-24 w-24 rounded-full object-cover sm:h-28 sm:w-28 md:h-48 md:w-48"
                        alt="Imagen {{ $user->name }}">
                @else
                    <img src="{{ Storage::url($user->profile) }}"
                        class="h-24 w-24 rounded-full object-cover sm:h-28 sm:w-28 md:h-48 md:w-48"
                        alt="Imagen {{ $user->name }}">
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-bold text-light-blue">{{ $user->full_name }}</h2>
                <p class="text-lg text-zinc-800">{{ $user->email }}</p>
            </div>
        </div>
        <div class="mx-auto mt-4 w-full px-4 md:w-4/5 lg:w-3/4">
            <form action="" class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex flex-[2] flex-col gap-2">
                        <x-input-store type="text" name="name" placeholder="Nombre" value="{{ $user->name }}"
                            label="Nombre" />
                    </div>
                    <div class="flex flex-[2] flex-col gap-2">
                        <x-input-store type="text" name="last_name" placeholder="Apellido" value="{{ $user->last_name }}"
                            label="Apellido" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="text" name="username" placeholder="Usuario" icon="user"
                            value="{{ $user->username }}" label="Usuario" />
                    </div>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex flex-[2] flex-col gap-2">
                        <x-input-store type="email" name="email" label="Correco electrónico"
                            placeholder="Correo electrónico" icon="email" value="{{ $user->email }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="text" name="phone" placeholder="+ 503 XXXX XXXX" icon="phone"
                            value="{{ $user->phone }}" label="Telefono" />
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="text" name="address_line_1" placeholder="Dirección línea 1" icon="location"
                            label="Dirección (línea 1)" />
                    </div>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex flex-[3] flex-col gap-2">
                        <x-input-store type="text" name="address_line_2" placeholder="Dirección línea 2"
                            label="Dirección (línea 2)" icon="location" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <x-input-store type="text" name="country" placeholder="País" label="País" />
                    </div>
                    <div class="flex flex-[2] flex-col gap-2">
                        <x-input-store type="text" name="city" placeholder="Ciudad" label="Ciudad" />
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <x-button-store text="Actualizar datos" class="w-full sm:w-auto" icon="save" typeButton="primary" />
                </div>
            </form>

            <div class="mt-8">
                <div class="text-center">
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
    </div>
@endsection
