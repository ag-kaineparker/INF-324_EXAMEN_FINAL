var camera, scene, renderer;
var cameraControls;
var clock = new THREE.Clock();
var ambientLight, light;

function init() {
    var canvasWidth = window.innerWidth * 0.9;
    var canvasHeight = window.innerHeight * 0.9;

    // CAMERA
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 80000);
    camera.position.set(1.5, 1, 1.5);
    camera.lookAt(new THREE.Vector3(0, 0, -0.3));

    // LIGHTS
    light = new THREE.DirectionalLight(0xFFFFFF, 0.7);
    light.position.set(1, 1, 1);
    light.target.position.set(0, 0, 0);
    light.target.updateMatrixWorld();

    ambientLight = new THREE.AmbientLight(0x111111);

    // RENDERER
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(canvasWidth, canvasHeight);
    renderer.setClearColor(0xAAAAAA, 1.0);
    renderer.gammaInput = true;
    renderer.gammaOutput = true;

    // Add to DOM
    var container = document.getElementById('container');
    container.appendChild(renderer.domElement);

    // CONTROLS
    cameraControls = new THREE.OrbitControls(camera, renderer.domElement);
    cameraControls.target.set(0, 0, 0);

    // Materiales con diferentes tonos de verde
    var materialRojo = new THREE.MeshBasicMaterial({ color: 0x004000 });
    var materialVerdeClaro = new THREE.MeshBasicMaterial({ color: 0x004000 });
    var materialVerdeMedio = new THREE.MeshBasicMaterial({ color: 0x004000 });
    var materialVerdeOscuro = new THREE.MeshBasicMaterial({ color: 0x004000 });


    // Pirámide 1 (base roja)
    var migeometria1 = new THREE.Geometry();
    migeometria1.vertices.push(new THREE.Vector3(0.0, 0.0, 0.0));
    migeometria1.vertices.push(new THREE.Vector3(0.3, 0.0, 0.0));
    migeometria1.vertices.push(new THREE.Vector3(0.3, 0.3, 0.0));
    migeometria1.vertices.push(new THREE.Vector3(0.0, 0.3, 0.0));
    migeometria1.vertices.push(new THREE.Vector3(0.15, 0.15, -0.3));
    migeometria1.faces.push(new THREE.Face3(0, 1, 2));
    migeometria1.faces.push(new THREE.Face3(0, 2, 3));
    migeometria1.faces.push(new THREE.Face3(0, 1, 4));
    migeometria1.faces.push(new THREE.Face3(1, 2, 4));
    migeometria1.faces.push(new THREE.Face3(2, 3, 4));
    migeometria1.faces.push(new THREE.Face3(3, 0, 4));
    var piramide1 = new THREE.Mesh(migeometria1, materialRojo);

    // Calcula las coordenadas del centro de la base cuadrada
    var centroBaseX = (migeometria1.vertices[0].x + migeometria1.vertices[1].x + migeometria1.vertices[2].x + migeometria1.vertices[3].x) / 4;
    var centroBaseY = (migeometria1.vertices[0].y + migeometria1.vertices[1].y + migeometria1.vertices[2].y + migeometria1.vertices[3].y) / 4;
    var centroBaseZ = (migeometria1.vertices[0].z + migeometria1.vertices[1].z + migeometria1.vertices[2].z + migeometria1.vertices[3].z) / 4;

    // Geometría y material para el cubo en el centro de la base cuadrada
    var cuboGeometry = new THREE.BoxGeometry(0.1, 0.1, 0.1);
    var cuboMaterial = new THREE.MeshBasicMaterial({ color: 0x5D3B0A });

    // Crea el cubo y colócalo en el centro de la base cuadrada
    var cubo = new THREE.Mesh(cuboGeometry, cuboMaterial);
    cubo.position.set(centroBaseX, centroBaseY, centroBaseZ+0.045);

    // SCENE
    scene = new THREE.Scene();
    scene.add(light);
    scene.add(ambientLight);

    scene.add(piramide1);
    scene.add(cubo);

    // Pirámide 2 (base verde claro)
    var migeometria2 = new THREE.Geometry();
    migeometria2.vertices.push(new THREE.Vector3(0.0, 0.0, -0.2));
    migeometria2.vertices.push(new THREE.Vector3(0.3, 0.0, -0.2));
    migeometria2.vertices.push(new THREE.Vector3(0.3, 0.3, -0.2));
    migeometria2.vertices.push(new THREE.Vector3(0.0, 0.3, -0.2));
    migeometria2.vertices.push(new THREE.Vector3(0.15, 0.15, -0.5));
    migeometria2.faces.push(new THREE.Face3(0, 1, 2));
    migeometria2.faces.push(new THREE.Face3(0, 2, 3));
    migeometria2.faces.push(new THREE.Face3(0, 1, 4));
    migeometria2.faces.push(new THREE.Face3(1, 2, 4));
    migeometria2.faces.push(new THREE.Face3(2, 3, 4));
    migeometria2.faces.push(new THREE.Face3(3, 0, 4));
    var piramide2 = new THREE.Mesh(migeometria2, materialVerdeClaro);

    // Pirámide 3 (base verde medio)
    var migeometria3 = new THREE.Geometry();
    migeometria3.vertices.push(new THREE.Vector3(0.0, 0.0, -0.4));
    migeometria3.vertices.push(new THREE.Vector3(0.3, 0.0, -0.4));
    migeometria3.vertices.push(new THREE.Vector3(0.3, 0.3, -0.4));
    migeometria3.vertices.push(new THREE.Vector3(0.0, 0.3, -0.4));
    migeometria3.vertices.push(new THREE.Vector3(0.15, 0.15, -0.7));
    migeometria3.faces.push(new THREE.Face3(0, 1, 2));
    migeometria3.faces.push(new THREE.Face3(0, 2, 3));
    migeometria3.faces.push(new THREE.Face3(0, 1, 4));
    migeometria3.faces.push(new THREE.Face3(1, 2, 4));
    migeometria3.faces.push(new THREE.Face3(2, 3, 4));
    migeometria3.faces.push(new THREE.Face3(3, 0, 4));
    var piramide3 = new THREE.Mesh(migeometria3, materialVerdeMedio);

    // Esferas en los vértices de las bases
    var esferaMaterial = new THREE.MeshBasicMaterial({ color: 0xE61D1D });
    var esferaGeometry = new THREE.SphereGeometry(0.02, 32, 32);

    var esfera1 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera1.position.copy(migeometria1.vertices[0]);
    var esfera2 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera2.position.copy(migeometria1.vertices[1]);
    var esfera3 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera3.position.copy(migeometria1.vertices[2]);
    var esfera4 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera4.position.copy(migeometria1.vertices[3]);

    var esfera5 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera5.position.copy(migeometria2.vertices[0]);
    var esfera6 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera6.position.copy(migeometria2.vertices[1]);
    var esfera7 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera7.position.copy(migeometria2.vertices[2]);
    var esfera8 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera8.position.copy(migeometria2.vertices[3]);

    var esfera9 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera9.position.copy(migeometria3.vertices[0]);
    var esfera10 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera10.position.copy(migeometria3.vertices[1]);
    var esfera11 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera11.position.copy(migeometria3.vertices[2]);
    var esfera12 = new THREE.Mesh(esferaGeometry, esferaMaterial);
    esfera12.position.copy(migeometria3.vertices[3]);

    // SCENE
    scene = new THREE.Scene();
    scene.add(light);
    scene.add(ambientLight);

    scene.add(piramide1);
    scene.add(cubo);

    scene.add(piramide2);
    scene.add(piramide3);

    scene.add(esfera1);
    scene.add(esfera2);
    scene.add(esfera3);
    scene.add(esfera4);

    scene.add(esfera5);
    scene.add(esfera6);
    scene.add(esfera7);
    scene.add(esfera8);

    scene.add(esfera9);
    scene.add(esfera10);
    scene.add(esfera11);
    scene.add(esfera12);
}

function animate() {
    window.requestAnimationFrame(animate);
    render();
}

function render() {
    var delta = clock.getDelta();
    cameraControls.update(delta);
    renderer.render(scene, camera);
}

try {
    init();
    animate();
} catch (e) {
    var errorReport = "Your program encountered an unrecoverable error, can not draw on canvas. Error was:<br/><br/>";
    $('#container').append(errorReport + e);
}
