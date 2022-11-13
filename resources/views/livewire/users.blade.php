<div>
    <h1 class="text-3xl">ผู้ใช้งาน API</h1>

    <div>
        @if(session()->has('message_user'))
            <div class="p-3 my-4 text-green-800 bg-green-300 rounded shadow-sm">
                {{ session('message_user') }}
            </div>
        @endif
    </div>

    <form class="w-full max-w-lg" wire:submit.prevent="addUser">

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3 mt-10">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              ข้อมูลผู้ใช้งาน :
            </label>
            <input class="w-full p-2 my-2 mr-2 border rounded shadow" id="grid-password" type="text" placeholder="ชื่อ-สกุลผู้ใช้งาน หรือหน่วยงานผู้ใช้">
            <p class="text-red-600 text-xs italic">ใส่ข้อมูลผู้ใช้งาน</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              ชื่อผู้ใช้ :
            </label>
            <input class="w-full p-2 my-2 mr-2 border rounded shadow" id="grid-password" type="text" placeholder="Username">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              อีเมล์ :
            </label>
            <input class="w-full p-2 my-2 mr-2 border rounded shadow" id="grid-password" type="text" placeholder="Email address">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                รหัสผ่าน :
              </label>
              <input class="w-full p-2 my-2 mr-2 border rounded shadow" id="grid-password" type="password" placeholder="รหัสผ่าน">
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-passwordconfirm">
                ยืนยันรหัสผ่าน :
              </label>
              <input class="w-full p-2 my-2 mr-2 border rounded shadow" id="grid-passwordconfirm" type="password" placeholder="ยืนยันรหัสผ่าน">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
              ระดับผู้ใช้งาน :
            </label>
            <div class="relative">
              <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>ผู้ดูแลระบบ</option>
                <option>ผู้บริหาร</option>
                <option>ผู้ใช้ทั่วไป</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
          </div>
        </div>
        <div class="py-2">
            <button type="submit" class="w-20 p-2 text-white bg-blue-500 rounded shadow">เพิ่มผู้ใช้</button>
        </div>
    </form>

    {{-- <form class="flex mt-4" wire:submit.prevent="addUser">
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="ชื่อ-นามสกุล หรือชื่อหน่วยงาน" wire:model.lazy="newFullname">
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="Username" wire:model.lazy="newUsername">
        <input type="email" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="Email" wire:model.lazy="newEmail">
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="Password" wire:model.lazy="newPassword">
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="rePassword" wire:model.lazy="newrePassword">
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="Tel" wire:model.lazy="newTel">
        <div class="py-2">
            <button type="submit" class="w-20 p-2 text-white bg-blue-500 rounded shadow">เพิ่มผู้ใช้</button>
        </div>
    </form> --}}

    @foreach($users as $user)
    <div class="p-3 my-4 border rounded shadow">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="text-lg">ชื่อผู้ใช้ : <b>{{ $user->fullname }}</b> (Tel. {{ $user->tel }})</p>
                <p class="py-1 mx-3 text-xs font-semibold text-gray-500">
                    {{ $user->created_at->diffForHumans() }}
                </p>
            </div>
            <i class="text-red-200 cursor-pointer fas fa-times hover:text-red-600" wire:click="remove({{$user->id}})"></i>
        </div>

        <p class="text-gray-800">Token : <b>1|tGY5pmloijsBVWLTy3HTN0CSvWt1uzqtaYc2ncxN</b></p>
    </div>
    @endforeach

    {{ $users->links() }}

</div>
