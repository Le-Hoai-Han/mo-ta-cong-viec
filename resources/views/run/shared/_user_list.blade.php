
    <div class="card">
        <div class="card-header">Nhân viên thuộc phòng/nhóm</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm table-borderless" id="users-table">
                    <thead>
                        <tr >
                            <th style="text-align: center">Ảnh đại diện</th>
                            <th style="text-align: center">Họ tên</th>
                            <td></td>
                            {{-- <th>Email</th>
                            <th>Quyền</th>
                            <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($profiles as $profile)
                            <tr>
                                <td style="text-align: center"><img src="{{$profile->user->profile_photo_url}}" style='width:100%;max-width:64px'></td>
                                <td style="text-align: center;vertical-align:middle">{{$profile->full_name}}</td>
                                <td style="text-align: center;vertical-align:middle"><a href="{{ route('trainee.show', $profile->user_id)}}" class='btn btn-sm btn-info'><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                    <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                                  </svg></a>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>
