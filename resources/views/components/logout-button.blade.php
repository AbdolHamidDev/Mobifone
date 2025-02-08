<form action="{{ route('logout') }}" method="POST" class="mt-3 text-center">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger w-100">Đăng xuất</button>
</form>
