<div class="md:grid md:grid-cols-5 md:gap-6">
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Thông tin liên lạc</h3>

            {{-- <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p> --}}
        </div>
    </div>


    <div class="mt-5 md:mt-0 md:col-span-4">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="phone">
                            {{ $profile->getLabel('phone')}}
                        </label>
                        <input class="txt-box" id="phone" name="phone" type="text" value="{{ old('phone',$profile->phone)}}">
                        @error('phone')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror  
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="address">
                            {{ $profile->getLabel('address')}}
                        </label>
                        <input class="txt-box" id="address" name="address" type="text" value="{{ old('address',$profile->address)}}">   
                        @error('address')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror             
                    </div>
                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="province_id">
                            {{ $profile->getLabel('province_id')}}
                        </label>
                        {{-- <x-combobox-custom name="province_id" id="province_id" class="txt-box" > 
                                @forelse ($provinces as $province)
                                    <option value="{{$province->id}}" >{{ $province->name}}</option>
                                @empty                                    
                                @endforelse

                        </x-combobox-custom> --}}
                        {{-- <input class="txt-box" id="province_id" name="province_id" type="text">   --}}
                        <select class="txt-box" id="province_id" name="province_id">
                            <option value=""></option>
                            @forelse ($provinces as $province)
                                    <option value="{{$province->id}}" {{ ($province->id == old('province_id',$profile->province_id))? "selected" : ""}} >{{ $province->name}}</option>
                                @empty                                    
                                @endforelse
                            
                        </select>              
                        @error('province_id')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="district_id">
                            {{ $profile->getLabel('district_id')}}
                        </label>
                        {{-- <input class="txt-box" id="district_id" name="district_id" type="text"> --}}
                        <select class="txt-box" id="district_id" name="district_id">
                            <option value=""></option>
                        </select>      
                        {{-- <x-combobox-custom name="district_id" id="district_id" class="txt-box" > 
                             

                        </x-combobox-custom> --}}
                        @error('district_id')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="workplace">
                            {{ $profile->getLabel('workplace')}}
                        </label>
                        <input class="txt-box" id="workplace" name="workplace" type="text" value="{{ old('workplace',$profile->workplace)}}">
                        @error('workplace')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror  
                    </div>

                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="position">
                            {{ $profile->getLabel('position')}}
                        </label>
                        <input class="txt-box" id="position" name="position" type="text" value="{{ old('position',$profile->position)}}">    
                        @error('position')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror             
                    </div>

                    
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <div style="display: none;" class="text-sm text-gray-600 mr-3">
                        Saved.
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Lưu thay đổi
                    </button>
                </div>
            </div>            
        </div>
    </div>
</div>
@push('scripts')

@endpush