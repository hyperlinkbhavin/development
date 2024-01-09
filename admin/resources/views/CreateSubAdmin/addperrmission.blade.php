@extends('index')
@section('title', 'Add Faq')
@section('main')

    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">
                        <div class="header">
                            <h2> ADD SUB ADMIN PERMISSION </h2><br>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal validate_form" role="form"
                                action="{{ route('store_permissions', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <table class="table">

                                    @php
                                        $permissions = $user->getPermissions($user->id);
                                        
                                    @endphp
                                    <input id="checkAll" type="checkbox" onclick="checkAll()">
                                    <label for="checkAll">Check All</label>
                                    @foreach ($menus as $menu)
                                        {{-- <div class="form-group"> --}}
                                        <tr>
                                            <td></td>
                                            <td>
                                                <label for="name">{{ $menu->menu_title }}</label>
                                            </td>

                                            {{-- <div class="col-sm-8"> --}}

                                            @if (!empty($menu->route))
                                                @php
                                                    $checked = '';
                                                    
                                                    if (isset($permissions[$menu->id]) && $permissions[$menu->id] == $menu->route) {
                                                        $checked = 'checked';
                                                    }
                                                @endphp
                                                @if ($menu->is_listed == '1')
                                                    {{-- <div class="col-sm-4 col-md-3"> --}}
                                                    <td>
                                                        <input id="permission{{ $menu->id }}" type="checkbox"
                                                            onchange="checkChild({{ $menu->id }})"
                                                            name="{{ 'permissions[' . $menu->id . ']' }}" class="cb-element"
                                                            value="{{ $menu->route }}" {{ $checked }}>
                                                        <label
                                                            for="permission{{ $menu->id }}">{{ $menu->menu_title }}</label>
                                                    </td>
                                                    {{--
                                            </div> --}}
                                                @endif
                                            @endif

                                            @foreach ($menu->getChildMenus($menu->id) as $key => $value)
                                                @php
                                                    $checked = '';
                                                    if (isset($permissions[$value->id]) && $permissions[$value->id] == $value->route) {
                                                        $checked = 'checked="checked"';
                                                    }
                                                @endphp
                                                {{-- <div class="col-sm-4 col-md-3"> --}}
                                                <td>
                                                    <input id="permission{{ $value->id }}" type="checkbox"
                                                        name="{{ 'permissions[' . $value->id . ']' }}"
                                                        class="cb-element child_{{ $value->parent_id }}"
                                                        value="{{ $value->route }}" {{ $checked }}
                                                        onchange="changeParent({{ $value->parent_id }},{{ $value->id }})">

                                                    <label
                                                        for="permission{{ $value->id }}">{{ $value->menu_title }}</label>
                                                </td> 
                                                {{--
                                            </div> --}}
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    {{-- </tr> --}}
                                </table>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            Save
                                        </button>
                                        <a href="{{ route('view_admin_list') }}"
                                            class="btn btn-default waves-effect waves-light m-l-5">
                                            Cancel
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("#checkAll").click(function() {
                $(".cb-element").prop("checked", this.checked);
            });

            //     $('.cb-element').click(function() {
            //         if ($('.cb-element:checked').length == $('.cb-element').length) {
            //         $('#checkAll').prop('checked', true);
            //         } else {
            //         $('#checkAll').prop('checked', false);
            //         }
            // });
        });

        function checkAll() {
            alert('jfsd')
        }

        function checkChild(parentid) {
            var is_select = $('#permission' + parentid)
            if ($('#permission' + parentid).is(':checked')) {
                $(".child_" + parentid).prop('checked', true);

            } else {
                $(".child_" + parentid).prop('checked', false);

            }

        }

        function changeParent(parentid, childid) {
            // console.log(childid)
            if ($('#permission' + childid).is(':checked')) {
                $('#permission' + parentid).prop('checked', true);

            }
            // var is_select = $('#permission'+parentid)

        }
    </script>
    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> --}}

@endsection
