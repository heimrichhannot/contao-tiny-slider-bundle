<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

$lang = &$GLOBALS['TL_LANG']['tl_tiny_slider_spread'];

/*
 * Felder
 */
$lang['tinySliderConfig'] = ['Tiny Slider Konfiguration', 'Wählen Sie eine Tiny Slider Konfiguration aus der Liste.'];
$lang['addTinySlider'] = ['Tiny Slider hinzufügen', 'Tiny Slider-Unterstützung hinzufügen'];
$lang['addGallery'] = ['Galerie hinzufügen', 'Fügen Sie eine Bildergalerie hinzu.'];
$lang['tinySliderMultiSRC'] = ['Quelldateien', 'Bitte wählen Sie eine oder mehrere Dateien oder Ordner aus dem Dateiverzeichnis aus. Wenn Sie einen Ordner auswählen, werden automatisch seine Dateien einbezogen.'];
$lang['tinySliderOrderSRC'] = ['Sortierreihenfolge', 'Die Sortierreihenfolge der Elemente.'];
$lang['tinySliderSortBy'] = ['Sortieren nach', 'Bitte wählen Sie die Sortierreihenfolge.'];
$lang['tinySliderUseHomeDir'] = ['Eigenes Verzeichnis verwenden', 'Das Heimatverzeichnis als Dateiquelle verwenden, wenn ein authentifizierter Benutzer vorhanden ist.'];
$lang['tinySliderSize'] = ['Bildgröße', 'Hier können Sie die Bildabmessungen und den Größenänderungsmodus festlegen.'];
$lang['tinySliderFullsize'] = ['Vollbildansicht/Neues Fenster', 'Öffnen Sie das Bild in voller Größe in einem Lightbox oder den Link in einem neuen Browserfenster.'];
$lang['tinySliderNumberOfItems'] = ['Gesamtanzahl der Bilder', 'Hier können Sie die Gesamtanzahl der Bilder begrenzen. Auf 0 setzen, um alle anzuzeigen.'];
$lang['tinySliderCustomTpl'] = ['Benutzerdefiniertes Elementtemplate', 'Hier können Sie das Standardelementtemplate überschreiben.'];
$lang['tinySlider_mode'] = ['Modus', 'Steuerung des Animationsverhaltens. Mit Karussell gleitet alles zur Seite, während die Galerie Überblendanimationen verwendet und alle Folien gleichzeitig ändert. Standardmäßig: `carousel`'];
$lang['tinySlider_axis'] = ['Achse', 'Die Achse des Sliders. Standardmäßig: `horizontal`'];
$lang['tinySlider_items'] = ['Elemente', 'Anzahl der im Ansichtsfenster angezeigten Folien. Wenn Folien weniger als `items` sind, wird der Slider nicht initialisiert. Standardmäßig: 1'];
$lang['tinySlider_gutter'] = ['Zwischenraum', 'Abstand zwischen den Folien (in "px"). Standardmäßig: 0'];
$lang['tinySlider_edgePadding'] = ['Rand-Padding', 'Abstand nach außen (in "px"). Standardmäßig: 0'];
$lang['tinySlider_fixedWidth'] = ['Feste Breite', 'Steuerung des Breitenattributs der Folien. Standardmäßig: false'];
$lang['tinySlider_autoWidth'] = ['Automatische Breite', 'Wenn `true`, wird die Breite jeder Folie ihre natürliche Breite als `inline-block`-Box sein. Standardmäßig: false'];
$lang['tinySlider_viewportMax'] = ['Maximale Ansichtsbreite', 'Maximale Ansichtsbreite für `fixedWidth`/`autoWidth`. Standardmäßig: false'];
$lang['tinySlider_slideBy'] = ['Folie um', 'Anzahl der Folien, die bei einem "Klick" weitergehen. Standardmäßig: 1'];
$lang['tinySlider_center'] = ['Zentrieren', 'Die aktive Folie im Ansichtsfenster zentrieren. Standardmäßig: false'];
$lang['tinySlider_controls'] = ['Steuerungen', 'Steuert die Anzeige und Funktionen von Steuerelementkomponenten (Vorherige/Nächste-Schaltflächen). Wenn true, zeigt die Steuerelemente an und fügt alle Funktionen hinzu. Für eine bessere Zugänglichkeit kann der Benutzer den Slider mit den Pfeiltasten links/rechts steuern, wenn eine Vorherige/Nächste-Schaltfläche fokussiert ist. Standardmäßig: true'];
$lang['tinySlider_controlsTextPrev'] = ['Text Vorherige Steuerelemente', 'Text oder Markup in den Vorherige-Schaltflächen. Standardmäßig: vorherige'];
$lang['tinySlider_controlsTextNext'] = ['Text Nächste Steuerelemente', 'Text oder Markup in den Nächste-Schaltflächen. Standardmäßig: nächste'];
$lang['tinySlider_controlsPosition'] = ['Position der Steuerelemente', 'Position der Steuerelemente. Standardmäßig: oben'];
$lang['tinySlider_controlsContainer'] = ['Container der Steuerelemente', 'Das Container-Element/Selector um die Vorherige/Nächste-Schaltflächen. Der controlsContainer muss mindestens 2 untergeordnete Elemente haben. Standardmäßig: false'];
$lang['tinySlider_prevButton'] = ['Benutzerdefinierte Vorherige Schaltflächen', 'Diese Option wird ignoriert, wenn controlsContainer ein Node-Element oder ein CSS-Selektor ist. Standardmäßig: false'];
$lang['tinySlider_nextButton'] = ['Benutzerdefinierte Nächste Schaltflächen', 'Diese Option wird ignoriert, wenn controlsContainer ein Node-Element oder ein CSS-Selektor ist. Standardmäßig: false'];
$lang['tinySlider_nav'] = ['Navigation', 'Steuert die Anzeige und Funktionen von Navigationskomponenten (Punkte). Wenn true, zeigt die Navigation an und fügt alle Funktionen hinzu. Standardmäßig: true'];
$lang['tinySlider_navPosition'] = ['Position der Navigation', 'Position der Navigation. Standardmäßig: oben'];
$lang['tinySlider_navContainer'] = ['Container der Navigation', 'Das Container-Element/Selector um die Punkte. navContainer muss mindestens so viele untergeordnete Elemente haben wie die Folien. Standardmäßig: false'];
$lang['tinySlider_navAsThumbnails'] = ['Navigation als Miniaturansichten', 'Gibt an, ob die Punkte Miniaturansichten sind. Wenn true, sind sie immer sichtbar, auch wenn mehr als 1 Folien im Ansichtsfenster angezeigt werden. Standardmäßig: false'];
$lang['tinySlider_arrowKeys'] = ['Pfeiltasten', 'Ermöglicht das Wechseln von Folien mit den Pfeiltasten. Standardmäßig: false'];
$lang['tinySlider_speed'] = ['Animationsgeschwindigkeit', 'Geschwindigkeit der Folienanimation (in "ms"). Standardmäßig: 300'];
$lang['tinySlider_autoplay'] = ['Autoplay', 'Aktiviert das automatische Wechseln von Folien. Standardmäßig: false'];
$lang['tinySlider_autoplayPosition'] = ['Position der Autoplay-Steuerung', 'Position der Autoplay-Steuerung. Standardmäßig: oben'];
$lang['tinySlider_autoplayTimeout'] = ['Timeout für Autoplay', 'Zeit zwischen zwei Autoplay-Folienwechseln (in "ms"). Standardmäßig: 5000'];
$lang['tinySlider_autoplayDirection'] = ['Richtung des Autoplay', 'Richtung der Folienbewegung (Aufsteigen/Absteigen des Folienindex). Standardmäßig: vorwärts'];
$lang['tinySlider_autoplayTextStart'] = ['Text Autoplay starten', 'Text oder Markup in der Autoplay-Start-Schaltfläche. Standardmäßig: starten'];
$lang['tinySlider_autoplayTextStop'] = ['Text Autoplay stoppen', 'Text oder Markup in der Autoplay-Stop-Schaltfläche. Standardmäßig: stoppen'];
$lang['tinySlider_autoplayHoverPause'] = ['Autoplay bei Hover anhalten', 'Stoppt das Gleiten bei Mouseover. Standardmäßig: false'];
$lang['tinySlider_autoplayButton'] = ['Autoplay-Schaltfläche', 'Die individuelle Autoplay-Start-/Stopp-Schaltfläche oder der Selektor. Standardmäßig: false'];
$lang['tinySlider_autoplayButtonOutput'] = ['Autoplay-Schaltfläche ausgeben', 'Gibt die Markup-Autoplay-Schaltfläche aus, wenn Autoplay true ist, aber keine benutzerdefinierte Autoplay-Schaltfläche angegeben ist. Standardmäßig: true'];
$lang['tinySlider_autoplayResetOnVisibility'] = ['Autoplay bei Sichtbarkeitsänderung zurücksetzen', 'Pausiert das Gleiten, wenn die Seite unsichtbar ist, und setzt es fort, wenn die Seite wieder sichtbar wird. Standardmäßig: true'];
$lang['tinySlider_animateIn'] = ['Einleitungsanimation', 'Name der Einleitungsanimationsklasse. Standardmäßig: tns-fadeIn'];
$lang['tinySlider_animateOut'] = ['Ausleitungsanimation', 'Name der Ausleitungsanimationsklasse. Standardmäßig: tns-fadeOut'];
$lang['tinySlider_animateNormal'] = ['Standardanimation', 'Name der Standardanimationsklasse. Standardmäßig: tns-normal'];
$lang['tinySlider_animateDelay'] = ['Animationsverzögerung', 'Zeit zwischen jeder Galerieanimation (in "ms"). Standardmäßig: false'];
$lang['tinySlider_loop'] = ['Schleife', 'Bewegt sich nahtlos durch alle Folien. Standardmäßig: true'];
$lang['tinySlider_rewind'] = ['Zurückspulen', 'Bewegt sich zum gegenüberliegenden Rand, wenn die erste oder letzte Folie erreicht ist. Standardmäßig: false'];
$lang['tinySlider_autoHeight'] = ['Automatische Höhe', 'Die Höhe des Slidercontainers ändert sich entsprechend der Höhe jeder Folie. Standardmäßig: false'];
$lang['tinySlider_responsive'] = ['Responsive', 'Ermöglicht Einstellungen bei bestimmter Bildschirmbreite. Fügen Sie zusätzliche Breakpoints und Einstellungen hinzu. Standardmäßig: null'];
$lang['tinySlider_responsive_breakpoint'] = ['Breakpoint', ''];
$lang['tinySlider_responsive_configuration'] = ['Konfiguration', ''];
$lang['tinySlider_lazyload'] = ['Lazy Load', 'Aktiviert das verzögerte Laden von Bildern, die derzeit nicht angezeigt werden, und spart so Bandbreite. Die Klasse .tns-lazy-img muss auf jedem Bild festgelegt werden, das verzögert geladen werden soll, wenn die Option lazyloadSelector nicht angegeben ist. Standardmäßig: true'];
$lang['tinySlider_lazyloadSelector'] = ['Lazy Load Selector', 'Der CSS-Selektor für verzögert geladene Bilder. Standardmäßig: .tns-lazy-img'];
$lang['tinySlider_touch'] = ['Touch', 'Aktiviert die Eingabeerkennung für Touch-Geräte. Standardmäßig: true'];
$lang['tinySlider_mouseDrag'] = ['Maus ziehen', 'Ändern der Folien durch Ziehen. Standardmäßig: false'];
$lang['tinySlider_preventActionWhenRunning'] = ['Aktion während der Transformation verhindern', 'Verhindert den nächsten Übergang, während der Slider transformiert wird. Standardmäßig: false'];
$lang['tinySlider_preventScrollOnTouch'] = ['Seitenverschiebung bei Berührung verhindern', 'Verhindert das Verschieben der Seite bei Touchmove. Wenn auf "auto" gesetzt, überprüft der Slider zuerst, ob die Berührungsrichtung der Sliderachse entspricht, und entscheidet dann, ob die Seitenverschiebung verhindert werden soll oder nicht. Wenn auf "force" gesetzt, verhindert der Slider immer die Seitenverschiebung. Standardmäßig: auto'];
$lang['tinySlider_swipeAngle'] = ['Swipe-Winkel', 'Swipe oder Drag wird nicht ausgelöst, wenn der Winkel nicht im Bereich liegt, wenn er eingestellt ist. Standardmäßig: 15'];
$lang['tinySlider_nested'] = ['Verschachtelt', 'Definieren Sie die Beziehung zwischen verschachtelten Slidern. Stellen Sie sicher, dass Sie zuerst den inneren Slider ausführen, da sonst die Höhe des inneren Slidercontainers falsch ist. Standardmäßig: false'];
$lang['tinySlider_freezable'] = ['Einfrierbar', 'Gibt an, ob der Slider eingefroren wird (Steuerelemente, Navigation, Autoplay und andere Funktionen funktionieren nicht mehr), wenn alle Folien auf einer Seite angezeigt werden können. Standardmäßig: true'];
$lang['tinySlider_disable'] = ['Deaktivieren (TinySlider-Eigenschaft)', 'Slider deaktivieren. Standardmäßig: false'];
$lang['tinySlider_skipInit'] = ['Initialisierung überspringen (TinySliderBundle-Eigenschaft)', 'Slider-Initialisierung überspringen. Standardmäßig: false'];
$lang['tinySlider_startIndex'] = ['Startindex', 'Der Startindex des Sliders. Standardmäßig: 0'];
$lang['tinySlider_onInit'] = ['Init-Callback', 'Callback, der bei der Initialisierung ausgeführt wird. Standardmäßig: false'];
$lang['tinySlider_useLocalStorage'] = ['Lokalen Speicher verwenden', 'Speichern Sie Browser-Fähigkeitsvariablen im localStorage und vermeiden Sie das erneute Erkennen jedes Mal, wenn der Slider läuft, wenn dies auf "true" gesetzt ist. Standardmäßig: true'];
$lang['cssClass'] = ['CSS-Klasse', 'Hier können Sie CSS-Klassen eingeben, die durch Leerzeichen getrennt werden und zur Slider-Container hinzugefügt werden.'];
$lang['tinySlider_enhanceAccessibility'] = ['Barrierefreiheit verbessern', 'Machen Sie nur aktive Slider-Elemente fokussierbar. Tabulatoren zum Wechseln deaktivieren.'];
$lang['tinySlider_displayPageNumber'] = ['Folie anzeigen Nummer', 'Das Anzeigen der Foliennummer aktiviert die Slider-Navigation und blendet sie aus.'];
/*
 * Legenden
 */
$lang['tiny_slider_legend'] = 'Tiny Slider-Einstellungen';
$lang['tiny_slider_gallery'] = 'Galerie-Einstellungen';
$lang['tiny_slider_config'] = 'Tiny Slider-Einstellungen';

/*
 * Popup
 */
$lang['editTinySliderConfig'][0] = 'Tiny Slider-Konfiguration bearbeiten';
$lang['editTinySliderConfig'][1] = 'Tiny Slider-Konfiguration mit ID %s bearbeiten';

