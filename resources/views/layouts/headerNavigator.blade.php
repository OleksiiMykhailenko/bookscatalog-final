<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Books catalog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/books/create">Add book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.forbes.com/sites/quickerbettertech/2019/06/17/best-history-books-of-all-time/#4c518f0840aa" target="_blank">Best History Books Of All Time</a>
            </li>
        </ul>
    </div>
    <div class="col-md-3">
        <form action="/search" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-dark">Search</button>
                </span>
            </div>
        </form>
    </div>
</nav>