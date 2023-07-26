<form action="{{route('detail-profile.becomeTrainer',$profile)}}" method="POST" id="form-become-trainer">
    @csrf
<div class="row">
    <div id="request-info"></div>
    <div class="col-12">
        <textarea id="term-condition" style="height:500px;overflow-y:auto;width:100%">
            @for ($i = 0; $i < 20; $i++)
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, reprehenderit sint? Consectetur blanditiis aliquid in autem soluta illo nihil perspiciatis, beatae quam necessitatibus unde quia odio officiis pariatur suscipit sapiente!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore iste quis similique maiores magni architecto vel ut beatae quidem ipsam totam culpa numquam provident mollitia tempore sunt, omnis dolore tempora?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus deserunt cupiditate voluptatum reprehenderit quia cumque labore nostrum quos unde odit? In, ratione natus! Quis, illo accusamus? Repellat corrupti quod consequatur. 
                </p>
            @endfor    
            </textarea>            
    </div>
</div>
<div class="row">
    <div class="col-12">
        <input type="checkbox" class="checkbox-inline" name="accept_condition" value="1" id="accept_condition">Tôi đã đọc và đồng ý với Điều khoản và điều kiện của công ty
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary btn-md" id="btn_request_trainer" disabled>Gửi yêu cầu</button>
    </div>
</div>
</form>
