<div class="contact-wrapper">
    <div class="contact-box">
        <div class="left-box">
            <p class="title">
                免费咨询
            </p>
            <form id="form_consult">
                <div class="input-box">
                    <div class="input-left">
                        <input type="hidden" name="type" value="">
                        <input type="text" name="name" placeholder="请输入您的姓名">
                        <input type="text" name="phone" placeholder="请输入您的电话">
                        <input type="text" name="email" placeholder="请输入您的邮箱">
                    </div>
                    <div class="input-right">
                        <textarea name="content" placeholder="请输入您想了解的更多信息"></textarea>
                    </div>
                </div>
            </form>
            <p class="tip">
                * 所有信息均已进行加密处理，请放心填写！
            </p>
            <div class="btn-wrapper">
                <div class="btn" onclick="consult()">
                    立即提交
                </div>
            </div>
        </div>
        <div class="right-box">
            <div class="tel">
                <img src="/front/images/common/tel.png" alt="">
                <span>24小时咨询热线</span>
            </div>
            <p class="number">
                {{$data['company']['custom_service_phone']}}
            </p>
            <div class="time">
                <img src="/front/images/common/chat.png" alt="">
                <span>在线咨询，周一至周五，9:00 - 18:00</span>
            </div>
            <div class="btn">
                <a class="no-color" target="_blank" href=" http://p.qiao.baidu.com/cps/chat?siteId=6088728&userId=7240211&siteToken=41095c4a656b37c14a45dc99176af78f" class="web_components_sidebar-item">
                    在线咨询
                </a>
            </div>
        </div>
    </div>
</div>