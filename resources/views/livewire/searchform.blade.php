<div>
    <form method="post" action="/">
        @csrf

        <div
            class="relative text-gray-500 focus-within:text-purple-600"
        >
            <input name="search_in_name" type='text' class="px-2
      py-1
      placeholder-gray-400
      text-gray-600
      relative
      bg-white bg-white
      rounded
      text-sm
      border border-gray-400
      outline-none
      focus:outline-none focus:ring
      "
                   placeholder="Search for a class by Name or Keyword"
            />

            <button class="bg-transparent
                hover:bg-blue-500
                text-blue-700
                font-semibold
                hover:text-white
                py-2 px-4 border
                border-blue-500
                hover:border-transparent
                rounded
                ">
                Search
            </button>
        </div>


    </form>
</div>
