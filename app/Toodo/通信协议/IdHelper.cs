using System;
using System.Threading;

namespace com.toodo
{
    /// <summary>
    /// 订单助手
    /// </summary>
    public class IdHelper
    {
        /// <summary>
        /// 防止创建类的实例
        /// </summary>
        private IdHelper() {
        }

        private static readonly object Locker = new object();
        private static int _sn = 0;

        /// <summary>
        /// 生成订单编号
        /// </summary>
        /// <returns></returns>
        public static string GenerateId() {
            //lock 关键字可确保当一个线程位于代码的临界区时，另一个线程不会进入该临界区。
            lock (Locker) {
                if (_sn == int.MaxValue) {
                    _sn = 0;
                } else {
                    _sn++;
                }

                Thread.Sleep(100);

                return DateTime.Now.ToString("yyyyMMddHHmmss") + _sn.ToString().PadLeft(10, '0');
            }
        }

        /// <summary>
        /// 产生唯一序列号
        /// </summary>
        /// <param name="tenChars">后缀冗余码区域</param>
        /// <returns></returns>
        public static string GenerateId(string tenChars) {
            //lock 关键字可确保当一个线程位于代码的临界区时，另一个线程不会进入该临界区。
            lock (Locker) {

                return DateTime.Now.ToString("yyyyMMddHHmmss") + tenChars.PadLeft(10, '0');
            }
        }
    }
}
