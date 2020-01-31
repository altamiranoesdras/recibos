@can('all option menu')
    @foreach($opciones ?? App\Models\Option::padres()->get() as $option)
        <li class="nav-item {{$option->hasTreeview()}} {{$option->openTreeView()}}">
            <a href="{{rutaOpcion($option)}}" class="nav-link {{$option->active()}}">
                <i class="nav-icon fa {{$option->icono_l}}"></i>
                <p>
                    {{$option->nombre}}
                    @if($option->hasChildren())
                        <i class="right fa fa-angle-left"></i>
                    @endif
                </p>
            </a>
            @if($option->hasChildren())
                <ul class="nav nav-treeview">
                    @include('layouts.partials.menu',['opciones' => $option->children])
                </ul>
            @endif
        </li>
    @endforeach
@else
    @foreach($opciones ?? Auth::user()->menu() as $option)
        <li class="nav-item {{$option->hasTreeview()}} {{$option->openTreeView()}}">
            <a href="{{rutaOpcion($option)}}" class="nav-link {{$option->active()}}">
                <i class="nav-icon fa {{$option->icono_l}}"></i>
                <p>
                    {{$option->nombre}}
                    @if($option->hasChildren())
                        <i class="right fa fa-angle-left"></i>
                    @endif
                </p>
            </a>
            @if($option->hasChildren())
                <ul class="nav nav-treeview">
                    @include('layouts.partials.menu',['opciones' => $option->children])
                </ul>
            @endif
        </li>
    @endforeach
@endcan
