<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('components/js-tree/themes/default/style.min.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <title>Tree - Application</title>
    </head>
    <body>
    <input type="text" value="" id="tree-main-search" placeholder="Search">
        <div id="tree-main"></div>

        <!-- Include jsTree component -->
        <script src="{{ asset('components/js-tree/jstree.min.js') }}"></script>
        <script src="{{ asset('js/tree.js') }}"></script>
        <!-- Init main scripts -->
        <script>
            tree.init(
                '#tree-main',
                '#tree-main-search',
                '{{ route('tree.list') }}',
                '{{ route('tree.create') }}',
                '{{ route('tree.update') }}',
                '{{ route('tree.delete') }}',
                '{{ route('tree.move') }}',
            );
        </script>
    </body>
</html>
