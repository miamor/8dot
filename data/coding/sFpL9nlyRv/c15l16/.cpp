#include <iostream>
using namespace std;
int main() {
  int a[4],i,j,t;
  cout<<"Nhap 4 so \n";
  cin>>a[0]>>a[1]>>a[2]>>a[3];
  for(i=0;i<3;i++)
      for(j=i+1;j<4;j++)
          if(a[i]>a[j])
        {
          t=a[i];
          a[i]=a[j];
          a[j]=t;
        }
  cout<<"Max= "<<a[3]<<endl;
  cout<<"Min= "<<a[0];
  return 0;
}

