<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    </head>
    <body>
        <div id="app">
            <header class="p-3 mb-3 border-bottom">
                <div class="container">
                    <menu_top></menu_top>
                </div>
            </header>
            <div class="container">
                <modal title="login">
                    <login></login>
                </modal>

                <modal title="task">
                    <task></task>
                </modal>

                <modal title="tasknew">
                    <tasknew></tasknew>
                </modal>

                <modal title="taskupdate">
                    <taskupdate></taskupdate>
                </modal>

                <modal title="confirmation">
                    <confirmation></confirmation>
                </modal>

                <modal title="commentnew">
                    <commentnew></commentnew>
                </modal>

                <test></test>
            </div>
        </div>
    </body>
</html>
