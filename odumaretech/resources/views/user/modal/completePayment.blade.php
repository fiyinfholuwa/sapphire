
    <!-- Modal -->
    <div class="modal fade" id="pay_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('user.complete.payment', $pay->id)}}" method="post">
   @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Payment Complete</h5>
        
      </div>
      <div class="modal-body">
        Are You Sure You want complete your payment, this action will take you to payment gateway where you pay the remaining 30% of your course fee.
      </div>
      <div class="modal-footer">
        <input type="hidden" name="payment" value="paystack"/>
        <input type="hidden" name="course_id" value="{{$pay->course_id}}"/>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" name="lock" class="btn btn-success btn-sm">Complete Payment</button>
      </div>
    </div>
    </form>
  </div>
</div>
