<transition name="fade" flag="0">
    <section v-if="isAppointmentShow" class="appointment-wrapper" @click.self="isAppointmentShow = false">
        <div class="appointment-cont">
            <div class="head" style="position:relative;box-sizing:border-box;">
                <img src="/front/images/overseas-property/detail/appointment-head.png" alt="">
                <i @click="isAppointmentShow = false">×</i>
            </div>
            <div class="text">
                <i></i>
                <span>立即预约</span>
                <i></i>
            </div>
            <div class="cont">
                <form id="form_consult">
                    <input type="hidden" name="type" value="">
                    <input type="text" placeholder="请输入您的姓名" name="name" value="">
                    <input type="text" placeholder="请输入您的手机号" name="phone" value="">
                    <input type="text" placeholder="请输入您的微信" name="wechat" value="">
                    <textarea placeholder="请输入您想了解的更多信息" name="content" value=""></textarea>
                    <p class="notice">
                        * 所有信息均已进行加密处理，请放心填写！
                    </p>
                    {{--                        @click="isAppointmentShow = false"--}}
                    <button class="submit_btn" type="button" onclick="consult()" @click="isAppointmentShow = false">
                        立即提交
                    </button>
                </form>
            </div>
        </div>
    </section>
</transition>