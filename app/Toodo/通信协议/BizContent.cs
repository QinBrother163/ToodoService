using Newtonsoft.Json;

namespace com.toodo
{

    public class BizContent<T>
    {
        public virtual string getBiz() {
            return JsonConvert.SerializeObject(this);
        }

        public static T parse(string json) {
            return JsonConvert.DeserializeObject<T>(json);
        }
    }


}
