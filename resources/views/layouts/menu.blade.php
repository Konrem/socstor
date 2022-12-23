    <div class="menu">
        <div class="content-menu">  
            <div class="logo logo-mobile">
                    <a class="menu-link" href="{{route('welcome')}}">
                        <img src="images/logo.png" alt="Студенський відділ волонтерів СумДУ">
                    </a>
                </div>
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
            <label class="btn-menu" for="hmt"></label>
            <!-- <ul class="hidden-menu" > -->
            <ul class="menu-block" >
                <li class="logo logo-mobile-none">
                    <a class="menu-link" href="{{route('welcome')}}">
                        <img src="images/logo.png" alt="Студенський відділ волонтерів СумДУ">
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('/')) ? 'active' : '' }}">
                    <a class="menu-link" href="{{route('welcome')}}">
                        Головна
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('news*')) ? 'active' : '' }}">
                    <a class="menu-link" href="{{route('news')}}">
                        Новини
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('volunteer*')) ? 'active' : '' }}">
                    <a class="menu-link" href="{{route('volunteer')}}">
                        Волонтерський рух
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('social*')) ? 'active' : '' }}">
                    <a class="menu-link" href="{{route('social')}}">
                        Студентська соціальна служба
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('department*')) ? 'active' : '' }}">
                    <a class="menu-link" href="{{route('department')}}">
                        Про нас
                    </a>
                </li>
            </ul>
        </div>
    </div>