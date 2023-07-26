<div class="md:grid md:grid-cols-5 md:gap-6 mb-6">
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Thông tin cá nhân</h3>

            {{-- <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p> --}}
        </div>
    </div>
<style type="text/css">
.switch-field {
	display: flex;
	margin-bottom: 36px;
	overflow: hidden;
}

.switch-field input {
	position: absolute !important;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	width: 1px;
	border: 0;
	overflow: hidden;
}

.switch-field label {
	background-color: #e4e4e4;
	color: rgba(0, 0, 0, 0.6);
	font-size: 14px;
	line-height: 1;
	text-align: center;
	padding: 8px 16px;
	margin-right: -1px;
	border: 1px solid rgba(0, 0, 0, 0.2);
	box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
	transition: all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
	background-color: #a5dc86;
	box-shadow: none;
}

.switch-field label:first-of-type {
	border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
	border-radius: 0 4px 4px 0;
}

/* This is just for CodePen. */

.form {
	max-width: 600px;
	font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
	font-weight: normal;
	line-height: 1.625;
	margin: 8px auto;
	padding: 16px;
}

h2 {
	font-size: 18px;
	margin-bottom: 8px;
}
</style>

    <div class="mt-5 md:mt-0 md:col-span-4">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="last_name">
                            {{ $profile->getLabel('last_name')}}
                        </label>
                    <input class="txt-box" id="last_name" name="last_name" type="text" value="{{ old('last_name',$profile->last_name)}}">
                    @error('last_name')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror 
                    </div>

                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="first_name">
                            {{ $profile->getLabel('first_name')}}
                        </label>
                        <input class="txt-box" id="first_name" name="first_name" type="text" value="{{ old('first_name',$profile->first_name)}}"> 
                        @error('first_name')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror                
                    </div>

                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="birthday">
                            {{ $profile->getLabel('birthday')}}
                        </label>
                        {{-- <input class="txt-box" id="birthday" name="birthday" type="date" required pattern="\d{4}-\d{2}-\d{2}"> --}}
                        <x-date-picker wire:model="date" name="birthday" value="{{ old('birthday',$profile->birthday)}}" class="txt-box"/>
                        @error('birthday')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror  
                    </div>

                    <div class="col-span-6 md:col-span-6">
                        <label class="block font-medium text-sm text-gray-700" for="gender">
                            {{ $profile->getLabel('gender')}}
                        </label>
                        <div class="switch-field mt-1">
                            <input type="radio" id="gender-male" name="gender" value="1" {{ (old('gender',$profile->gender))  == 1 ?"checked":""}}/>
                            <label for="gender-male">Nam</label>
                            <input type="radio" id="gender-female" name="gender" value="0" {{ (old('gender',$profile->gender))  == 0 ?"checked":""}}/>
                            <label for="gender-female">Nữ</label>
                        </div>
                        @error('gender')
                            <span class="text-red-500 help">{{ $message }} </span>
                        @enderror  
                        {{-- <input class="txt-box" id="gender" name="gender" type="text">  --}}
                        {{-- <label class="md:w-2/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" name="gender[]" value="1" type="radio">
                            <span class="text-sm">
                              Nam
                            </span>
                          </label>
                          <label class="md:w-2/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" name="gender[]" value="0" type="radio">
                            <span class="text-sm">
                              Nữ
                            </span>
                          </label> --}}
                    </div>

                    
                </div>
            </div>            
        </div>
    </div>
</div>
