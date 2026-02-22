<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Language logic
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$text = [
    'name_label' => ($lang == 'en') ? "Let's start with your name" : "သင့်နာမည်လေး အရင်ပြောပြပေးပါ",
    'questions' => [
        1 => [
            ($lang == 'en') ? "How does your skin feel 1 hour after washing, without products?" : "မျက်နှာသစ်ပြီး ၁ နာရီအကြာမှာ သင့်အသားအရေက ဘယ်လိုခံစားရလဲ။",
            "Very tight or flaky", "Comfortable and smooth", "Oily only on T-zone", "Shiny all over",
            "အရမ်းတင်းခြောက်ပြီး အဖတ်များကွာတယ်", "နေလို့ကောင်းပြီး ချောမွေ့တယ်", "နဖူးနဲ့ နှာခေါင်းပဲ အဆီပြန်တယ်", "မျက်နှာတစ်ခုလုံး ပြောင်လက်နေတယ်"
        ],
        2 => [
            ($lang == 'en') ? "How often do you experience breakouts?" : "ဝက်ခြံ ဒါမှမဟုတ် အဖုအပိမ့်တွေ ဘယ်လောက်အဖြစ်များသလဲ။",
            "Almost never", "Rarely", "Occasionally in certain areas", "Frequently",
            "လုံးဝနီးပါး မဖြစ်သလောက်ပဲ", "ဖြစ်ခဲပါတယ်", "တချို့နေရာတွေမှာ ရံဖန်ရံခါဖြစ်တယ်", "ခဏခဏ အမြဲလိုလိုဖြစ်တယ်"
        ],
        3 => [
            ($lang == 'en') ? "What do your pores look like?" : "သင့်ချွေးပေါက်လေးတွေက ဘယ်လိုပုံစံရှိလဲ။",
            "Small, invisible", "Visible but not large", "Large in T-zone", "Large all over",
            "အရမ်းသေးပြီး မမြင်ရသလောက်ပဲ", "မြင်ရပေမယ့် သိပ်မကျယ်ဘူး", "နဖူးနဲ့ နှာခေါင်းမှာ သိသိသာသာကျယ်တယ်", "မျက်နှာအနှံ့မှာ ကျယ်နေတယ်"
        ],
        4 => [
            ($lang == 'en') ? "How does your skin react to new products?" : "Skincare အသစ်တွေ စမ်းသုံးရင် ဘယ်လိုဖြစ်တတ်လဲ။",
            "No reaction", "Rarely irritated", "Sometimes red or itchy", "Very sensitive",
            "ဘာမှမဖြစ်ဘူး၊ ခံနိုင်ရည်ရှိတယ်", "ယားယံတာမျိုး ဖြစ်ခဲတယ်", "တစ်ခါတလေ နီမြန်းတာမျိုးရှိတယ်", "အရမ်း Sensitive ဖြစ်ပြီး နီလွယ်တယ်"
        ],
        5 => [
            ($lang == 'en') ? "Describe your skin texture." : "သင့်အသားအရေရဲ့ အထိအတွေ့က ဘယ်လိုလဲ။",
            "Rough and dry", "Soft and balanced", "Mix of dry and oily", "Greasy and thick",
            "ကြမ်းတမ်းပြီး ခြောက်သွေ့တယ်", "နူးညံ့ပြီး မျှတနေတယ်", "ခြောက်တလှည့် အဆီပြန်တလှည့်ပဲ", "အဆီများပြီး ထူအန်းအန်းဖြစ်နေတယ်"
        ],
        6 => [
            ($lang == 'en') ? "How is your makeup/sunscreen after a few hours?" : "မိတ်ကပ် ဒါမှမဟုတ် နေလောင်ကာ လိမ်းပြီး နာရီအနည်းငယ်ကြာရင် ဘယ်လိုဖြစ်လဲ။",
            "Becomes patchy/dry", "Stays perfect", "Shiny only on nose/forehead", "Slides off due to oil",
            "ကွက်ပြီး ခြောက်သွားတယ်", "ပုံမှန်အတိုင်း အဆင်ပြေနေတုန်းပဲ", "နှာခေါင်းနဲ့ နဖူးပဲ ပြောင်လာတယ်", "အဆီကြောင့် အရည်ပျော်ပြီး ပြောင်ထွက်လာတယ်"
        ],
        7 => [
            ($lang == 'en') ? "How does cold weather affect your skin?" : "ရာသီဥတု အေးတဲ့အခါ သင့်အသားအရေက ဘယ်လိုဖြစ်တတ်လဲ။",
            "Extremely dry/cracked", "Needs a bit more lotion", "Only cheeks get dry", "Feels better/less oily",
            "အရမ်းခြောက်ပြီး အက်ကွဲချင်သလိုဖြစ်တယ်", "Lotion နည်းနည်းပိုလိမ်းရင် ရပြီ", "ပါးပဲ ခြောက်တတ်တယ်", "နေလို့ပိုကောင်းပြီး အဆီပြန်တာသက်သာတယ်"
        ],
        8 => [
            ($lang == 'en') ? "When you wake up, how is your face?" : "မနက်အိပ်ရာနိုးနိုးချင်းမှာ သင့်မျက်နှာက ဘယ်လိုလဲ။",
            "Tight and dull", "Fresh and normal", "Greasy T-zone only", "Oily everywhere",
            "တင်းကြပ်ပြီး ညိုညစ်နေတယ်", "ကြည်လင်ပြီး ပုံမှန်ပဲ", "နဖူးနဲ့ နှာခေါင်းပဲ ဆီဝင်းနေတယ်", "မျက်နှာတစ်ခုလုံး အဆီတွေနဲ့ စေးကပ်နေတယ်"
        ]
    ],

    'user_page' => [
            'profile' => ($lang == 'en') ? "My Profile" : "ကျွန်ုပ်၏ ပရိုဖိုင်",
            'skin_profile' => ($lang == 'en') ? "My Skin Profile" : "အသားအရေ အချက်အလက်",                
            'consultation' => ($lang == 'en') ? "Book Consultation" : "ဆရာဝန်နှင့် ပြသရန်",
            'appointments' => ($lang == 'en') ? "My Appointments" : "ရက်ချိန်းများ",
            'orders' => ($lang == 'en') ? "My Orders" : "မှာယူမှုများ",
            'detected_type' => ($lang == 'en') ? "Your Detected Type:" : "စစ်ဆေးတွေ့ရှိချက် -",
            'not_analyzed' => ($lang == 'en') ? "Not Analyzed Yet" : "မစစ်ဆေးရသေးပါ",
            'expert_tips' => ($lang == 'en') ? "✨ Expert Recommendations" : "✨ ကျွမ်းကျင်သူ၏ အကြံပြုချက်",
    ],
];