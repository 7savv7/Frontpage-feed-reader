<header>
    <div>
        <div class="logo">
            <div class="icon">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-squares-subtract-icon lucide-squares-subtract">
                    <path d="M10 22a2 2 0 0 1-2-2" />
                    <path d="M16 22h-2" />
                    <path d="M16 4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-5a2 2 0 0 1 2-2h5a1 1 0 0 0 1-1z" />
                    <path d="M20 8a2 2 0 0 1 2 2" />
                    <path d="M22 14v2" />
                    <path d="M22 20a2 2 0 0 1-2 2" />
                </svg>
            </div>

            <p>Frontpage</p>
        </div>

        <ul>
            <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="/">Feed</a></li>
            <li><a class="{{ request()->routeIs('digest') ? 'active' : '' }}" href="digest">Digest</a></li>
            <li><a class="{{ request()->routeIs('discover') ? 'active' : '' }}" href="discover">Discover</a></li>
        </ul>
    </div>

    <div class="right">
        <div class="search">
            <input type="text" placeholder="">

            <div class="placeholder">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                    <path d="m21 21-4.34-4.34" />
                    <circle cx="11" cy="11" r="8" />
                </svg>

                <p>Search articles...</p>

                <div>
                    <p>/</p>
                </div>
            </div>
        </div>

        <a href="?add-url">
            <div class="add">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </div>
        </a>

        <div class="avatar">
            <img src="https://static.vecteezy.com/system/resources/previews/025/667/911/non_2x/guest-icon-design-vector.jpg" alt="avatar">

            <div class="dropdown">
                <form action="/sign-out" method="POST">
                    @csrf
                    <button type="submit">Sign Out</button>
                </form>
            </div>
        </div>
    </div>

    @if (request()->has('add-url'))
    <div class="feed-url">
        <form action="/" method="post">
            @csrf
            <input type="text" name="feed-url" placeholder="Add feed url">
            @if ($errors->any())
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
            @endif
            <button type="submit">Add link</button>
        </form>
    </div>
    @endif
</header>