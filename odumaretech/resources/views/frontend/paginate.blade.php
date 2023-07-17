@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li class="previous"> <a href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="fa fa-angle-left"></i></a> </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <li> <a href="{{ $paginator->url($i) }}">{{ $i }}</a> </li>
    @endfor
    <li class="next"> <a href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="fa fa-angle-right"></i></a> </li>
</ul>
@endif

