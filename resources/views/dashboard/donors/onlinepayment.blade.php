<html>
    <body onload="document.donorform.submit()">
        <div class="card m-10">
            <div class="card-header">{{ __('Payment online using RMA Payment Gateway') }}
            </div>
            <div class="card-body">
                Do not close this window till payment is completed successfully.You can view the donation details from the this <a href="{{ route('dashboard.donors.donationhistory') }}">link.</a>
                <form method="POST" name="donorform" target="_self" action="https://bfssecure.rma.org.bt/BFSSecure/makePayment" target="_blank">
                <!-- <form method="POST" name="donorform" target="_self" action="http://uatbfssecure.rma.org.bt:8080/BFSSecure/makePayment" target="_blank">  -->
                <!-- <form method="POST" action="https://bfssecure.rma.org.bt/BFSSecure/nvpapi" target="_blank"> -->
                    <input type="text" name="bfs_msgType" value="{{ $bfs_msgType }}"><br>
                    <input type="text" name="bfs_benfTxnTime" value="{{ $bfs_benfTxnTime }}"><br>
                    <input type="text" name="bfs_orderNo" value="{{ $bfs_orderNo }}"><br>
                    <input type="text" name="bfs_benfId" value="{{ $bfs_benfId }}"><br>
                    <input type="text" name="bfs_benfBankCode" value="{{ $bfs_benfBankCode }}"><br>
                    <input type="text" name="bfs_txnCurrency" value="{{ $bfs_txnCurrency }}"><br>
                    <input type="text" name="bfs_txnAmount" value="{{ $bfs_txnAmount }}"><br>
                    <input type="text" name="bfs_remitterEmail" value="{{ $bfs_remitterEmail }}"><br>
                    <input type="text" name="bfs_checkSum" value="{{ $bfs_checkSum }}"><br>
                    <input type="text" name="bfs_paymentDesc" value="{{ $bfs_paymentDesc }}"><br>
                    <input type="text" name="bfs_version" value="{{ $bfs_version }}"><br>
                </form>  
            </div>
        </div>
    </body>
</html>