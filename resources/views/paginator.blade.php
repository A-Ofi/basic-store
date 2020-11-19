<div id="pag" class="paginator">

    @php
        $pages = $paginator->total() / $paginator->count();
    @endphp

    <a href="{{ $paginator->previousPageUrl()  }}">previous</a>

    @for ($page = 1; $page <= $pages; $page++)
        <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
    @endfor

    <a href="{{ $paginator->nextPageUrl() }}">next</a>    
</div>

<script>
    let unclickables = document.querySelectorAll(
        'a[href=""], a[href="{{$paginator->url($paginator->currentPage())}}"]'
        )//current page shouldn't be clickable
    unclickables.forEach(anchor => anchor.className = 'unclickable')

    
</script>