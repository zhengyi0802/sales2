<div>
    <x-adminlte-button label="新增分類" theme="primary" icon="fas fa-plus" wire:click="openModal" />

    @if (session()->has('message'))
        <x-adminlte-alert theme="success" dismissable>
            {{ session('message') }}
        </x-adminlte-alert>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>名稱</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $index }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <x-adminlte-button theme="info" icon="fas fa-edit" label="編輯" wire:click="edit({{ $category->id }})" />
                        <x-adminlte-button theme="danger" icon="fas fa-trash" label="刪除" wire:click="delete({{ $category->id }})" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}

    {{-- Modal --}}
    @if($modalOpen)
        <x-adminlte-modal id="categoryModal" title="{{ $isEditMode ? '編輯分類' : '新增分類' }}" theme="primary"
            static-backdrop wire:ignore.self>
            <x-adminlte-input name="name" label="分類名稱" wire:model.defer="name" placeholder="請輸入名稱" />
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

            <x-slot name="footerSlot">
                <x-adminlte-button theme="secondary" label="取消" data-dismiss="modal" wire:click="closeModal" />
                <x-adminlte-button theme="primary" label="儲存" wire:click="{{ $isEditMode ? 'update' : 'store' }}" />
            </x-slot>
        </x-adminlte-modal>

        <script>
            window.addEventListener('DOMContentLoaded', function () {
                $('#categoryModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#categoryModal').modal('hide');
            });
        </script>
    @endif
</div>
