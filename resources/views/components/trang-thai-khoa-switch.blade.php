<label class="switch-trang-thai switch">
    <a href="{{ $url1 }}" class="{{ $active == $url1 ? 'active' : '' }} btn btn-small btn-danger text-white" id="switch-button-item-1">{{ $label1 }}</a>
  <a href="{{ $url2 }}" class="{{ $active == $url2 ? 'active' : '' }}  btn btn-small btn-success" id="switch-button-item-2">{{ $label2 }}</a>
</label>

@push('styles')
    <style>
        .switch {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin: 10px; */
        }

        .switch a {
            display: inline-block;
            padding: 10px;
            /* margin: 5px; */
            color: #ffffff;
            background-color: #cccccc;
            text-decoration: none;
            border-radius: 0;
        }

        .switch a:first-child{
            border-radius: 5px 0 0 5px;
        }

        .switch a:last-child{
            border-radius: 0 5px 5px 0;
        }

        .switch a.active {
            background-color: #007bff;
        }

        .switch a:hover {
            background-color: #0069d9;
            cursor: pointer;
        }
    </style>
@endpush 
@push('scripts')
    <script>
        const url1 = document.querySelector('#switch-button-item-1');
        const url2 = document.querySelector('#switch-button-item-2');

        url1.addEventListener('click', () => {
            url1.classList.add('active');
            url2.classList.remove('active');
        // Code to redirect to URL 1
        });

        url2.addEventListener('click', () => {
            url2.classList.add('active');
            url1.classList.remove('active');
        // Code to redirect to URL 2
    });
</script>
@endpush