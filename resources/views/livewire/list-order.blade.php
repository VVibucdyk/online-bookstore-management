<div>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;1,600&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: 'Source Sans Pro';
        }
    </style>
    <div class="w-screen">

        <div class="mx-auto mt-8 max-w-screen-lg px-2">
            <div class="sm:flex sm:items-center sm:justify-between flex-col sm:flex-row">
                <p class="flex-1 text-base font-bold text-gray-900">Latest Order</p>
            </div>

            @empty($dataOrder)
                <h1 class="mb-10 text-center text-2xl font-bold">Kamu belum order apa - apa</h1>
            @endempty

            @if (!empty($dataOrder))
            <div class="mt-6 overflow-hidden rounded-xl border shadow">
                <table class="min-w-full border-separate border-spacing-y-2 border-spacing-x-2">
                    <thead class="hidden border-b lg:table-header-group">
                        <tr class="">
                            <td width="50%" class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">
                                Invoice</td>

                            <td class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">Date</td>

                            <td class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">Amount</td>

                            <td class="whitespace-normal py-4 text-sm font-medium text-gray-500 sm:px-6">Status</td>
                        </tr>
                    </thead>

                    <tbody class="lg:border-gray-300">
                        @foreach ($dataOrder as $item)
                        <tr class="">
                            <td width="50%" class="whitespace-no-wrap py-4 text-sm font-bold text-gray-900 sm:px-6">
                                {{$item['transaction_id']}}
                                <div class="mt-1 lg:hidden">
                                    <p class="font-normal text-gray-500">{{ date("Y-m-d", strtotime($item['transaction_date'])) }}</p>
                                </div>
                            </td>

                            <td
                                class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                {{ date("Y-m-d", strtotime($item['transaction_date'])) }}</td>

                            <td class="whitespace-no-wrap py-4 px-6 text-right text-sm text-gray-600 lg:text-left">
                                Rp.{{ $item['amount'] }}

                                @if ($item['status'] == 'pending')
                                <div
                                class="flex mt-1 ml-auto w-fit items-center rounded-full bg-blue-200 py-1 px-2 text-left font-medium text-blue-500 lg:hidden">
                                Pending</div>
                                @elseif($item['status'] == 'canceled')
                                <div
                                    class="flex mt-1 ml-auto w-fit items-center rounded-full bg-red-200 py-1 px-2 text-left font-medium text-red-500 lg:hidden">
                                    Canceled</div>
                                @elseif($item['status'] == 'completed')
                                <div
                                    class="flex mt-1 ml-auto w-fit items-center rounded-full bg-blue-600 py-2 px-3 text-left text-xs font-medium text-white lg:hidden">
                                    Complete</div>
                                @endif
                            </td>

                            <td
                                class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500 sm:px-6 lg:table-cell">
                                @if ($item['status'] == 'pending')
                                <div class="inline-flex items-center rounded-full bg-blue-200 py-1 px-2 text-blue-500">
                                    Pending</div>
                                @elseif($item['status'] == 'canceled')
                                <div class="inline-flex items-center rounded-full bg-red-200 py-1 px-2 text-red-500">
                                    Canceled</div>
                                @elseif($item['status'] == 'completed')
                                <div
                                    class="inline-flex items-center rounded-full bg-blue-600 py-2 px-3 text-xs text-white">
                                    Complete</div>
                                @endif
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

    </div>
</div>
