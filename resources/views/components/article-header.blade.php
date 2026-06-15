@vite('resources/css/components/article-header.css')

<div class="feeds-header">
    <p class="info">All Items <span>{{$total}} unread</span></p>

    <div class="options">
        <div class="layout">
            <div class="layout-option layout-selected">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu">
                    <path d="M4 5h16" />
                    <path d="M4 12h16" />
                    <path d="M4 19h16" />
                </svg>
            </div>

            <div class="layout-option">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-grid-icon lucide-layout-grid">
                    <rect width="7" height="7" x="3" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="14" rx="1" />
                    <rect width="7" height="7" x="3" y="14" rx="1" />
                </svg>
            </div>

            <div class="layout-option">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-table-of-contents-icon lucide-table-of-contents">
                    <path d="M16 5H3" />
                    <path d="M16 12H3" />
                    <path d="M16 19H3" />
                    <path d="M21 5h.01" />
                    <path d="M21 12h.01" />
                    <path d="M21 19h.01" />
                </svg>
            </div>
        </div>

        <div class="button filter">
            <p>Newest</p>
        </div>

        <div class="button refresh">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-ccw-icon lucide-refresh-ccw">
                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                <path d="M3 3v5h5" />
                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                <path d="M16 16h5v5" />
            </svg>

            <p>Refresh</p>
        </div>

        <div class="button read">
            <p>Mark all read</p>
        </div>
    </div>
</div>