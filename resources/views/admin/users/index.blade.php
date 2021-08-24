

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Permission
                    </th>




                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Deleting
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($users->count()>0)
                    @foreach( $users as $user )
                    <tr>

                    <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex-shrink-0 h-20 w-20">
                        <div class="ml-4">
                        <img  src="{{asset(@$user->profile->avatar)}}" class=" h-20 w-20 rounded-full"  alt="">
                      </div>
                    </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">

                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                            <br/>
                              {{ $user->name }}
                            </div>

                          </div>
                        </div>
                      </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="p-4 text-center rounded-lg leading-7 font-bold w-32  text-gray-900">

                             @if ($user->admin)
                             <a  href="{{route('users.notmake_admin', ['id' =>$user->id])}}" class=" bg-red-400 p-3 rounded-md text-white">
                               Remove admin
                             </a>
                             @else
                             <a  href="{{route('users.make_admin', ['id' =>$user->id])}}" class=" bg-green-400 text-white p-3 rounded-lg">
                                Not admin
                             </a>
                             @endif

                      </div>
                    </td>


                      @if(Auth::user()->id  != $user->id)
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="bg-red-400 p-2  text-center rounded-lg leading-7 font-bold w-12 text-sm text-gray-900">
                               <a  href="{{route('users.delete', ['id'=>$user->id])}}" class="text-black">
                                <span class="iconify" data-icon="mdi:trash-off" data-inline="true">
                                </span></a>
                        </div>
                    </td>
                      @endif


                  </tr>
                      @endforeach
                    @else
                    <tr>
                        <th>No Users To display</th>
                    </tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>






</x-app-layout>





















