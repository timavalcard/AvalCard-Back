
<aside class="admin-sidebar">
    <ul>
        @foreach(config("AdminSidebar") as $configItem)

            @if(!array_key_exists("permission",$configItem)
            ||  auth()->user()->hasPermissionTo($configItem["permission"])
            || auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN)
            )
            <li class="{{ str_contains(url()->current(),$configItem["link"]) ? 'active' : '' }}">
                <a href="{{ $configItem["link"] }}">
                    <i class="fa {{  $configItem["icon"] }}"></i>
                    {{  $configItem["name"] }}
                    @if(!empty($configItem["notify"]))
                        <span class="admin-count">{{ $configItem["notify"] }}</span>
                    @endif
                </a>
                @if(!empty($configItem["children"]))

                    <ul>
                        @foreach($configItem["children"] as $children)
                        <li>
                            <a href="{{ $children["link"] }}">

                                {{ $children["name"] }}

                            </a>
                        </li>
                         @endforeach
                    </ul>
                @endif
            </li>
            @endif
        @endforeach
    </ul>
</aside>
