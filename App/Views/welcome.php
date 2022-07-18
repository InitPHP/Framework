<?php
if (!defined('BASE_DIR')) {
    die("Access denied.");
}
view_require('header');
?>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0"><i class="fa-brands fa-php"></i> Framework</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link" aria-current="page" href="https://github.com/InitPHP/Framework" title="MVC Framework"><i class="fa-brands fa-github"></i> View on Github</a>
            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>Minimalist MVC Web Framework</h1>
        <p class="lead">You are ready to develop very well. You can start development from the <code>/App/</code> directory. </p>
        <p class="lead">
            <a href="https://github.com/InitPHP/Framework" title="MVC Framework" class="btn btn-lg btn-secondary fw-bold border-white bg-white"><i class="fa-brands fa-github"></i> View on Github</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">
        <p>
            Copyright &copy; <?php echo date("Y"); ?> <a href="https://initphp.github.io/license.txt" target="_blank" title="MIT License" class="text-white"><i class="fa-solid fa-file-certificate"></i> MIT License</a> - Developed by <a href="https://github.com/muhammetsafak" target="_blank" title="@muhammetsafak" class="text-white"><i class="fa-brands fa-github"></i> Muhammet ŞAFAK</a>.
        </p>
    </footer>
</div>
</body>
</html>