@extends('layouts.app')

@section('title')
    Start
@endsection

@section('content')
<div>
    <div class="flex">
        <div class="flex flex-col flex-initial text-gray-700 text-center bg-blue-900 p-4 h-screen justify-between">
            <div>
                <img class="self-center" src="{{ asset('/img/icon-192.png') }}" style="height: 45px" />
            </div>
            <div class="flex flex-col">
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">L</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">O</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">L</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">I</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">C</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">O</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">N</div>
                <div class="bg-blue-600 text-white text-center px-3 py-2 rounded" style="margin: 3px">S</div>
            </div>
        </div>
        <div class="flex">
            <div class="flex-1 px-8 py-6">
              <div class="mb-16">
                  <h2 class="font-bold text-2xl mb-3 mr-2">Your content</h2>
                  <div class="flex flex-row flex-wrap">
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="{{ asset('/img/icon-192.png') }}">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Identity ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  Authentication for your applications.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://static.thenounproject.com/png/630729-200.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Profile ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  Personal information.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://static.thenounproject.com/png/354462-200.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                Support ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  Support directly from the developers.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://static.thenounproject.com/png/5919-200.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Community ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  Fanatics of Aeoss, together.
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div>
                  <h2 class="font-bold text-2xl mb-3 mr-2">Your connections</h2>
                  <div class="flex flex-row flex-wrap">
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://www.stickpng.com/assets/images/580b57fcd9996e24bc43c53e.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Twitter ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  A social media network based on birds.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://www.stickpng.com/assets/images/584ac2d03ac3a570f94a666d.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Facebook ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  A social media network for friends.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="http://pluspng.com/img-png/google-logo-png-open-2000.png">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Google ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  The big boi of the internet.
                              </div>
                          </div>
                      </div>
                      <div class="flex-col w-1/6 border-t-2 border-gray-200 mr-2 shadow-xl">
                          <div class="flex-1 text-gray-700 text-center m-4">
                              <img class="inline w-12" src="https://www.sccpre.cat/png/big/1/14507_discord-logo-png.jpg">
                          </div>
                          <div class="h-px bg-gray-400 m-4 rounded-full h-px"></div>
                          <div class="flex-1 text-gray-700 text-center m-2">
                              <div class="text-blue-600 text-lg cursor-pointer">
                                  Discord ➜
                              </div>
                              <div class="text-gray-600 text-sm">
                                  The chat platform with an ironic name.
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
