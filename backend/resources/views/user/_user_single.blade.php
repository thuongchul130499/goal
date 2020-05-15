<tr id="item-user-{{ $user->id }}">
    <td class="pr-0 pl-4">
        <a href="{{ route('show-user', $user->id) }}"><img class="profile-img img-sm" src="{{ $user->ava }}" alt="profile image"></a>
    </td>
    <td class="pl-md-0">
        <small class="text-black font-weight-medium d-block">{{ $user->fullname }}</small>
        <span class="text-gray">
        <span class="status-indicator rounded-indicator small bg-primary"></span>
        @if (isFollowing($user, $following_ids))
            <button 
                class="btn btn-like btn-xs btn-outline-danger follow"
                type="button"
                data-user-id="{{ $user->id }}"
                data-type="unfollow"
            >UnFollow</button>
        @else
            @if($user->id != auth()->id())
                <button 
                    class="btn btn-like btn-xs btn-success follow"
                    type="button"
                    data-type="follow"
                    data-user-id="{{ $user->id }}"
                >Follow</button>
            @endif
        @endif
    </td>
    <td>
        <div class="grouped-images mt-2">
            @include('user.follower_user', ['lists' => $user->followers])
        </div>
    </td>
    <td>
        <div class="grouped-images mt-2">
            @include('user.follower_user', ['lists' => $user->followings])
        </div>
    </td>
</tr>