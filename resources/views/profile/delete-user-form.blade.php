<x-jet-action-section>
    <x-slot name="title">
    مسح البريد الإلكترونى الخاص بك
    </x-slot>

    <x-slot name="description">
       
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
        بمجرد حذف حسابك ، سيتم حذف جميع موارده وبياناته بشكل دائم. قبل حذف حسابك ، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                مسح
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
            مسح البريد الإلكترونى الخاص بك
            </x-slot>

            <x-slot name="content">
            هل انت متأكد انك تريد حذف حسابك؟ بمجرد حذف حسابك ، سيتم حذف جميع موارده وبياناته بشكل دائم. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك بشكل دائم

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="كلمة المرور"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                   ألغاء 
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    مسح البريد الإلكترونى
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
