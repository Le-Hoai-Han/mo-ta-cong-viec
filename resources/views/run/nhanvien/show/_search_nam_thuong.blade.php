<x-simple-card extClass="mt-3" headerClass="bg-gradient-warning text-white ">
    <x-slot name="title">
        <h5 class="text-white mb-0"><h6 class="text-white mb-3">Tra cứu theo năm</h6>
    </x-slot>
    <div >
        
        <input type="text" name="sch_nam_thuong" id="sch_nam_thuong" length="4" max-size="4" value="{{$nam}}" class=" form-control mb-2"/>

    </div>
</x-simple-card>



@push('scripts')
<script async>
    const schFormButton = document.querySelector('#sch_nam_thuong');
    let schFormValue = schFormButton.val;
    schFormButton.addEventListener('blur',function(e){
        if(e.target.value != schFormValue) {
            schFormValue  = e.target.value;
            window.open("{{url()->current()}}?nam="+schFormValue,'_self');
            console.log(e.target.value);
        }
    })
    </script>
@endpush 