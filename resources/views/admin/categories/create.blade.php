<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


<div class="flex justify-between">


@if(Auth::check())
<div class="overflow-scroll bg-red-200 text-black text-1xl w-80 font-bold leading-8 grid grid-cols-1 rounded-md  h-screen ml-20">
    <div class="pt-10 px-2">
     <div class="pb-8"><a href="/admin/post/create" class="bg-white rounded-lg  p-3">create a new post</a></div>
     <div class="pb-8"><a href="{{ route('home') }}" class="bg-white rounded-lg  p-3">Home Page</a></div>
     <div class="pb-8"><a href="{{ route('category.create') }}" class="bg-white rounded-lg  p-3">create category</a></div>
     <div class="pb-8"><a href="{{ route('category.index') }}" class="bg-white rounded-lg  p-3">create categories</a></div>
    </div>
</div>
@endif


        <div class="w-full ml-60 mt-10 mr-10">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/mountain.jpg')" title="Mountain">
        </div>
        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
@include('admin.includes.errors');


            <div class="mb-8">
            <div class="text-gray-900 mt-10 font-bold text-xl mb-2">Create Catergory</div>
  <div class="mt-5 md:mt-0 md:col-span-2">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700">name</label>
                  <input type="text" name="name" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
              <button type="submit" class="inline-flex w-40 py-4 px-10 border border-transparent text-sm font-medium rounded-md text-white bg-green-600">
                Save Category
              </button>
            </div>
          </div>
        </form>
    </div>
  </div>
        </div>
        </div>
        </div>
      </div>


    </div>
</x-app-layout>
