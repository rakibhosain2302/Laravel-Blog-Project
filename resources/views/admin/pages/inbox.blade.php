@extends('admin.layouts.header')

@prepend('style')
    <style>
        tr.odd td,
        tr.even td {
            padding-left: 2px;
            padding-bottom: 5px;
        }

        .show-btn a {
            padding: 0px 7px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: #2c4533;
            color: white;
            border-color: black;
        }

        .seen-btn {
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: #11642a;
            color: white;
            border-color: black;
        }

        .reply-btn a {
            padding: 0px 7px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: #392b74;
            color: white;
            border-color: black;
        }

        .btn-danger {
            padding: 6px 10px;
            margin-top: 4px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: #f90f0f;
            color: white;
            border-color: #f8f5f5;
        }

        .btn-secondary {
            padding: 6px 10px;
            margin-top: 4px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: 1px solid transparent;
            background: #f90f0f;
            color: white;
            border-color: #f8f5f5;
        }
    </style>
@endprepend

@section('content')
    @include('admin.layouts.sidebar')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Inbox Messages ({{ $unreadCount ?? 0 }})</h2>
            @if (session('mtoseen'))
                <p class="successMsg">{{ session('mtoseen') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="2%">SL</th>
                            <th width="5%">Fast-Name</th>
                            <th width="5%">Last-Name</th>
                            <th width="5%">Email</th>
                            <th width="20%">Messages</th>
                            <th width="2%">View</th>
                            <th width="2%">Seen</th>
                            <th width="2%">Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $id => $message)
                            <tr class="odd slider gradeX">
                                <td>{{ ++$id }}</td>
                                <td style="font-weight: 600;">{{ $message->firstname }}</td>
                                <td style="font-weight: 600;">{{ $message->lastname }}</td>
                                <td style="font-weight: 600;">{{ $message->email }}</td>
                                <td style="padding-top: 5px;">{{ Str::limit($message->message, 80, '.....') }}</td>
                                <td class="show-btn"><a href="{{ route('message.show', $message->id) }}">View</a></td>
                                <td>
                                    <form action="{{ route('messages.seen', $message->id) }}" method="POST">
                                        @csrf
                                        <button class="seen-btn" type="submit">Seen</button>
                                    </form>
                                </td>
                                <td class="reply-btn"><a href="{{ route('message.edit', $message->id) }}">Reply</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Seen Messages ({{ $seenCount ?? 0 }})</h2>
            @if (session('success'))
                <p class="successMsg">{{ session('success') }}</p>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="2%">SL</th>
                            <th width="5%">Name</th>
                            <th width="5%">Email</th>
                            <th width="20%">Messages</th>
                            <th width="2%">Undo</th>
                            <th width="2%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seenMessages as $id => $msg)
                            <tr>
                                <td>{{ ++$id }}</td>
                                <td>{{ $msg->firstname }} {{ $msg->lastname }}</td>
                                <td>{{ $msg->email }}</td>
                                <td>{{ Str::limit($msg->message, 30) }}</td>
                                <td>
                                    <form action="{{ route('messages.undo', $msg->id) }}" method="POST">
                                        @csrf
                                        <button class="btn-secondary" type="submit">Undo</button>
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ route('message.destroy', $msg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Delete Button -->
                                        <button class="btn-danger" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this record?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('admin.layouts.footer')

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
@endsection

@section('title')
    inbox
@endsection
