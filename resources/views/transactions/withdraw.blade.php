<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-messages.message />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="border-b px-4 py-3 flex justify-between">
                        <h4>Withdraw Money</h4>
                        <h4>Available Balance: <span class="font-bold">{{ auth()->user()->account->balance. ' ' . auth()->user()->account->currency_code }}</span></h4>
                    </div>
                    <form class="p-4" method="post" action="{{ route('withdraw.process') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="text" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter amount to withdraw">
                            @error('amount')
                            <div class="text-red-700 py-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="remarks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                            <input type="text" id="remarks" name="remarks"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Remarks">
                            @error('remarks')
                            <div class="text-red-700 py-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Withdraw</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
