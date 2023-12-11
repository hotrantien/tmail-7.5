<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('SMTP Configuration') }}
    </x-slot>

    <x-slot name="description">
        {{ __('SMTP settings are used for sending emails from your TMail.') }}
    </x-slot>
    
    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="hostname" value="{{ __('Hostname') }}" />
            <x-jet-input id="hostname" type="text" class="mt-1 block w-full" wire:model.defer="state.smtp.host"/>
            <x-jet-input-error for="state.smtp.host" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="port" value="{{ __('Port') }}" />
            <x-jet-input id="port" type="text" class="mt-1 block w-full" wire:model.defer="state.smtp.port"/>
            <x-jet-input-error for="state.smtp.port" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="encryption" value="{{ __('Encryption') }}" />
            <div class="relative">
                <select class="form-input rounded-md shadow-sm mt-1 block w-full cursor-pointer" wire:model.defer="state.smtp.encryption">
                    <option value="notls">{{ __('None') }}</option>
                    <option value="ssl">{{ __('SSL') }}</option>
                    <option value="tls">{{ __('TLS') }}</option>
                </select>
            </div>
            <x-jet-input-error for="state.smtp.encryption" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.smtp.username"/>
            <x-jet-input-error for="state.smtp.username" class="mt-2" />
        </div>
        <div x-data="{ show: false }" class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <div class="relative">
                <x-jet-input id="password" x-bind:type="show ? 'text' : 'password'" class="mt-1 block w-full" wire:model.defer="state.smtp.password"/>
                <div x-on:click="show = !show" x-text="show ? 'HIDE' : 'SHOW'" class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-5 text-xs"></div>
            </div>
            <x-jet-input-error for="state.smtp.password" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="from_address" value="{{ __('From Address') }}" />
            <x-jet-input id="from_address" type="text" class="mt-1 block w-full" wire:model.defer="state.smtp.from.address"/>
            <x-jet-input-error for="state.smtp.from.address" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="from_name" value="{{ __('From Name') }}" />
            <x-jet-input id="from_name" type="text" class="mt-1 block w-full" wire:model.defer="state.smtp.from.name"/>
            <x-jet-input-error for="state.smtp.from.name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>