<div class="sidebar_fixed">
    <div class="list-group">
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'user_list') active @endif" onclick='location.href="{{ url('admin/user_list') }}"'>ユーザー一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'delete_user_list') active @endif" onclick='location.href="{{ url('admin/delete_user_list') }}"'>退会ユーザー一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'user_list') active @endif" onclick='location.href="{{ url('admin/item_list') }}"'>投稿動画一覧</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'push') active @endif" onclick='location.href="{{ url('admin/push_list') }}"'>お知らせ通知</button>
        <button type="button" class="px-2 list-group-item list-group-item-action @if( $type == 'transfer_list') active @endif" onclick='location.href="{{ url('admin/transfer_list') }}"'>振込依頼一覧</button>
    </div>
</div>