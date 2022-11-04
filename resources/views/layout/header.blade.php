<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src=" {{ asset('/js/bootstrap.min.js') }} "></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=" {{ route('users.show') }} ">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href=" {{ route('admin') }} ">Admin</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href=" {{ route('logout') }} ">LogOut</a>
                        </li>

                    </form>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>
