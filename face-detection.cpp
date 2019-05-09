#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/objdetect/objdetect.hpp>
#include <opencv2/highgui/highgui.hpp>
#include <iostream>
#include <vector>
 
using namespace cv;
using namespace std;
 
int main()
{
    Mat src, gray;
    VideoCapture capture = VideoCapture(0);
    capture.set(CV_CAP_PROP_FRAME_WIDTH, 340);
    capture.set(CV_CAP_PROP_FRAME_HEIGHT, 280);
 
    string cascade_file= "./Cascades/haarcascades/haarcascade_frontalface_alt.xml";
    CascadeClassifier cascade;
    if (cascade_file.empty() || !cascade.load(cascade_file))
    {
        cout << "Hata: cascade dosyası bulunamadı!n";
        return -1;
    }
 
    while(1)
    {
        capture.read(src);
        cvtColor(src, gray, CV_BGR2GRAY);
        equalizeHist(gray, gray);
        vector<Rect> faces;
 
        // cascade fonksiyonu, parametreleri kullanım alanınıza göre değiştirebilirsiniz.
        cascade.detectMultiScale(gray, faces, 1.1, 3, CV_HAAR_DO_CANNY_PRUNING|CV_HAAR_SCALE_IMAGE, Size(30,30));
 
        // bulunan yüz ifadelerini dikdörtgen içine alma
        for (int i = 0; i < faces.size(); i++)
        {
            Rect rect = faces[i];
            rectangle(src, rect, CV_RGB(0,255,0), 2);
        }
 
        imshow("frame",src);
 
        char c = cvWaitKey(30);
        if ( c == 27 )
            break;
    }
 
    return 0;
}
