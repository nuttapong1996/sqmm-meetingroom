import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: window.ReverbConfig?.key,
    wsHost: window.ReverbConfig?.host,
    wsPort: window.ReverbConfig?.port ?? 80,
    wssPort: window.ReverbConfig?.port ?? 443,
    forceTLS: window.ReverbConfig?.scheme === "https",
    enabledTransports: ["ws", "wss"],
});
