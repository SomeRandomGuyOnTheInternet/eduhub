<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules Navigation</title>
    <style>
        /* Add your CSS styles here */
        .nav-bar {
            width: 200px;
        }
        .nav-bar ul {
            list-style-type: none;
            padding: 0;
        }
        .nav-bar li {
            padding: 8px;
            background-color: #f8f9fa;
            margin-bottom: 4px;
        }
        .nav-bar li a {
            text-decoration: none;
            color: #000;
        }
        .sub-menu {
            display: none;
            padding-left: 20px;
        }
        .sub-menu li {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <h2>This is the left nav bar bro</h2>
        <h2>Modules:</h2>
        <ul>
            @foreach($modules as $module)
                <li>
                    <a href="javascript:void(0)" onclick="toggleSubMenu('{{ $module->module_name }}')">{{ $module->module_name }}</a>
                    <ul class="sub-menu" id="sub-{{ $module->module_name }}">
                        <li><a href="{{ url('home/'.$module->module_id) }}">Home</a></li>
                        <li><a href="{{ route('modules.content', ['moduleFolderId' => $module->module_id]) }}">Content</a></li>
                        <!-- Inside your foreach loop in the nav bar HTML -->
<!-- <a href="{{ route('modules.content', ['moduleFolderId' => $module->module_id]) }}">{{ $module->module_name }}</a> -->

                        <li><a href="{{ url('assignments/'.$module->module_id) }}">Assignments</a></li>
                        <li><a href="{{ url('quizzes/'.$module->module_id) }}">Quizzes</a></li>
                        <li><a href="{{ url('news/'.$module->module_id) }}">News</a></li>
                        <li><a href="{{ url('meetings/'.$module->module_id) }}">Meetings</a></li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        function toggleSubMenu(moduleName) {
            var subMenu = document.getElementById('sub-' + moduleName);
            if (subMenu.style.display === 'none' || subMenu.style.display === '') {
                subMenu.style.display = 'block';
            } else {
                subMenu.style.display = 'none';
            }
        }
    </script>
</body>
</html>
