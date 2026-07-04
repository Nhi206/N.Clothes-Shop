<div>
    <h3 class="text-lg font-bold text-error mb-2 flex items-center gap-2">
        <span class="material-symbols-outlined">delete_forever</span>
        Xóa tài khoản
    </h3>
    <p class="text-outline text-sm mb-6">
        Khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào bạn muốn giữ lại.
    </p>

    <button onclick="document.getElementById('deleteModal').classList.remove('hidden')" class="bg-error text-white px-6 py-2 rounded-xl font-semibold hover:bg-error-container transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">delete</span>
        Xóa tài khoản
    </button>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-surface rounded-3xl p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-error flex items-center gap-2">
                <span class="material-symbols-outlined">warning</span>
                Xác nhận xóa tài khoản
            </h3>
            <button onclick="document.getElementById('deleteModal').classList.add('hidden')" class="text-outline hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <p class="text-outline text-sm mb-6">
                Bạn có chắc chắn muốn xóa tài khoản? Khi tài khoản bị xóa, tất cả tài nguyên và dữ liệu sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu để xác nhận.
            </p>

            <div class="mb-6">
                <label for="password" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Mật khẩu</label>
                <input id="password" name="password" type="password" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" placeholder="Nhập mật khẩu của bạn" required>
                @error('password')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="flex-1 bg-outline text-white py-2 rounded-xl font-semibold hover:bg-outline-variant transition-colors">Hủy</button>
                <button type="submit" class="flex-1 bg-error text-white py-2 rounded-xl font-semibold hover:bg-error-container transition-colors">Xóa tài khoản</button>
            </div>
        </form>
    </div>
</div>
