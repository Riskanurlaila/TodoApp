<nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top">
    <div class="container d-flex justify-content-between">
        <!-- Brand -->
        <a class="navbar-brand fw-bolder" href="#">{{ config('app.name') }}</a>

        <!-- Form Pencarian -->
        <form action="{{ route('home.search') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" 
                   placeholder="Cari sesuatu..." style="width: 250px;">
            <button type="submit" class="btn btn-light">🔍</button>
        </form>
    </div>
</nav>
