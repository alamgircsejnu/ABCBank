<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="border-b px-4 py-3">
                        Statement of account
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DATETIME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                AMOUNT
                            </th>
                            <th scope="col" class="px-6 py-3">
                                TYPE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                REMARKS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                BALANCE
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($transactions as $key => $transaction)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->created_at->format('d-m-Y H:i:s A') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->amount }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->details }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->balance }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-center" colspan="6">No transactions yet</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if(count($transactions))
                        <div class="p-2">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
