const Ziggy = {"url":"http:\/\/crud-post.loc","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"home":{"uri":"api","methods":["GET","HEAD"]},"login":{"uri":"api\/auth\/login","methods":["POST"]},"user":{"uri":"api\/auth\/user","methods":["GET","HEAD"]},"admin.posts":{"uri":"api\/admin\/posts","methods":["GET","HEAD"]},"admin.filter":{"uri":"api\/admin\/filter","methods":["POST"]},"admin.search":{"uri":"api\/admin\/search","methods":["POST"]},"admin.get.post":{"uri":"api\/admin\/post\/get","methods":["GET","HEAD"]},"admin.upload.image":{"uri":"api\/admin\/image\/upload","methods":["POST"]},"admin.update.post":{"uri":"api\/admin\/post\/updatePost","methods":["POST"]},"admin.save.post":{"uri":"api\/admin\/post\/savePost","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
