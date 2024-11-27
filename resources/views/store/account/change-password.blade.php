@extends('layouts.template')
@section('title', 'Cambiar contraseña')
@section('content')
    <div class="flex items-center justify-center py-8">
        <section class="z-10 w-4/12 rounded-3xl bg-white p-4 py-10">
            <div class="text-center">
                <h1 class="font-pluto-r text-2xl font-bold text-blue-store">Cambiar contraseña</h1>
            </div>
            <form action="{{ Route('account.edit-password') }}" method="POST" class="mx-auto mt-4 flex w-3/4 flex-col gap-4"
                id="formChangePassword">
                @csrf
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="password" name="password" label="Contraseña actual"
                        placeholder="Ingresa tu contraseña actual" class="text-zinc-800" icon="key" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="new-password" name="new-password" label="Nueva contraseña"
                        placeholder="Ingresa la nueva contraseña" class="text-zinc-800" icon="key" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="confirm-password" name="confirm-password" label="Confirma contraseña"
                        icon="key" placeholder="Confirma la contraseña" class="text-zinc-800" />
                </div>
                <div class="flex items-center justify-center">
                    <x-button-store typeButton="primary" id="btn-change-password" type="button" text="Cambiar contraseña"
                        class="font-medium" icon="reset-password" />
                </div>
            </form>
        </section>
    </div>
@endsection
